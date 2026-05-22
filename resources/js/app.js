import Alpine from 'alpinejs';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

const IPV4 = /^(25[0-5]|2[0-4]\d|1?\d?\d)(\.(25[0-5]|2[0-4]\d|1?\d?\d)){3}$/;
const IPV6 = /^(([0-9a-fA-F]{1,4}:){7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|::(ffff(:0{1,4})?:)?((25[0-5]|(2[0-4]|1?\d)?\d)\.){3}(25[0-5]|(2[0-4]|1?\d)?\d))$/;

const isValidIp = (ip) => IPV4.test(ip) || IPV6.test(ip);

Alpine.data('ipApi', (cfg = {}) => ({
    base: cfg.base || '/api',
    item: 'ip',
    ipInput: '',
    result: '',
    loading: false,
    error: false,
    copiedUrl: false,
    copiedResult: false,

    get ipIsValid() {
        return isValidIp(this.ipInput.trim());
    },
    get showInvalid() {
        return this.ipInput.length > 0 && !this.ipIsValid;
    },
    get url() {
        const ip = this.ipIsValid ? this.ipInput.trim() : '';
        return ip ? `${this.base}/${ip}/${this.item}` : `${this.base}/${this.item}`;
    },
    get curl() {
        return `curl ${this.url}`;
    },

    selectItem(value) {
        this.item = value;
    },

    async submit() {
        if (!this.ipIsValid || this.loading) {
            return;
        }
        this.error = false;
        this.loading = true;
        this.result = '';
        try {
            const response = await fetch(this.url);
            if (!response.ok) {
                throw new Error('Request failed');
            }
            const text = await response.text();
            if (this.item === 'json') {
                try {
                    this.result = JSON.stringify(JSON.parse(text), null, 4);
                } catch (e) {
                    this.result = text;
                }
            } else {
                this.result = text;
            }
        } catch (e) {
            this.error = true;
        } finally {
            this.loading = false;
        }
    },

    copy(text, which) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text);
        }
        this[which] = true;
        setTimeout(() => {
            this[which] = false;
        }, 3000);
    },
}));

window.Alpine = Alpine;
Alpine.start();

const initMaps = () => {
    document.querySelectorAll('[data-map]').forEach((el) => {
        if (el.dataset.initialized) {
            return;
        }
        el.dataset.initialized = '1';

        const lat = parseFloat(el.dataset.lat);
        const lng = parseFloat(el.dataset.lng);
        const fixed = el.dataset.fixed === '1';
        const rtl = document.documentElement.dir === 'rtl';

        if (Number.isNaN(lat) || Number.isNaN(lng)) {
            return;
        }

        const offset = 0.03;
        const center = fixed
            ? [lat - offset, rtl ? lng + offset * 2 : lng - offset * 2]
            : [lat, lng];

        const map = L.map(el, { scrollWheelZoom: false }).setView(center, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(map);

        L.marker([lat, lng], {
            icon: L.icon({ iconUrl: el.dataset.marker, iconAnchor: [12, 41] }),
        }).addTo(map);
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMaps);
} else {
    initMaps();
}
