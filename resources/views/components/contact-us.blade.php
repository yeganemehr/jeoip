<div class="contact-us">
    <div class="contact-us__title-row">
        <p class="contact-us__title">{{ __('messages.contact.title') }}</p>
    </div>
    <div class="contact-us__list">
        <div class="contact-us-item">
            <x-mdi-phone class="contact-us-item__icon" />
            <p class="contact-us-item__title">{{ __('messages.contact.phone') }}</p>
            <a href="tel:+983134420301" target="_blank" class="contact-us-item__value" style="color:#000;">031-34420301</a>
        </div>
        <div class="contact-us-item">
            <x-mdi-email class="contact-us-item__icon" />
            <p class="contact-us-item__title">{{ __('messages.contact.email') }}</p>
            <a href="mailto:hi@dnj.co.ir" target="_blank" class="contact-us-item__value" style="color:#000;">hi@dnj.co.ir</a>
        </div>
        <div class="contact-us-item">
            <x-mdi-headset class="contact-us-item__icon" />
            <p class="contact-us-item__title">{{ __('messages.contact.support') }}</p>
            <a href="https://t.me/dnjco" target="_blank" class="contact-us-item__value" style="color:var(--primary-color);">{{ __('messages.contact.click') }}</a>
        </div>
    </div>
</div>
