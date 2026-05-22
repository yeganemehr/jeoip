<div class="ip-api" x-data="ipApi(@js(['base' => url('/api')]))">
    <div class="ip-api__header">
        <x-mdi-arrow-top-left class="section-arrow" />
        <p class="ip-api__title">{{ __('messages.ip.api.title') }}</p>
    </div>
    <p class="ip-api__subtitle">{{ __('messages.ip.api.subtitle') }}</p>

    <div class="ip-api__items">
        @foreach (['ip' => 'ip', 'country' => 'country', 'country-code' => 'country_code', 'city' => 'city', 'asn' => 'asn', 'json' => 'json'] as $value => $key)
        <p class="ip-api-item"
            :class="{ 'ip-api-item--selected': item === @js($value) }"
            @click="selectItem(@js($value))">{{ __('messages.ip.api.items.' . $key) }}</p>
        @endforeach
    </div>

    {{-- curl command --}}
    <div class="ip-api-box" dir="ltr">
        <div style="display:flex;align-items:center;min-width:0;">
            <x-mdi-currency-usd class="ip-api-box__icon" />
            <span class="ip-api-box__value" style="margin:0 .5rem;" @click="copy(curl, 'copiedUrl')" x-text="curl"></span>
        </div>
        <div class="ip-api-copied" x-show="copiedUrl" x-cloak>
            <span class="ip-api-copied__value">{{ __('messages.ip.api.copied') }}</span>
            <x-mdi-check class="ip-api-copied__icon" />
        </div>
    </div>

    {{-- result --}}
    <template x-if="(result && !loading) || error">
        <div>
            <div class="ip-api-box" dir="ltr">
                <template x-if="error">
                    <span class="ip-api-box__value" style="cursor:default;">{{ __('messages.ip.api.result_error') }}</span>
                </template>
                <template x-if="!error">
                    <pre class="ip-api-box__value" @click="copy(result, 'copiedResult')" x-text="result"></pre>
                </template>
            </div>
            <div class="ip-api-copied" x-show="copiedResult" x-cloak>
                <x-mdi-check class="ip-api-copied__icon" />
                <span class="ip-api-copied__value">{{ __('messages.ip.api.copied') }}</span>
            </div>
        </div>
    </template>

    {{-- check another IP --}}
    <div class="ip-api-input">
        <p class="ip-api-input__title">{{ __('messages.ip.api.input.title') }}</p>
        <div class="ip-api-input__fields">
            <input type="text"
                class="ip-api-input__input"
                :class="{ 'ip-api-input__input--invalid': showInvalid }"
                placeholder="{{ __('messages.ip.api.input.placeholder') }}"
                x-model="ipInput"
                @keydown.enter="submit()">
            <button type="button" class="ip-api-input__submit" :disabled="!ipIsValid || loading" @click="submit()">
                <span class="spinner spinner--sm" x-show="loading" x-cloak></span>
                <span x-show="!loading">{{ __('messages.ip.api.input.check') }}</span>
            </button>
        </div>
    </div>
</div>