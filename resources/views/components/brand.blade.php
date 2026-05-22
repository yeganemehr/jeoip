@props(['row' => false, 'iconSize' => null])

<div class="brand">
    <a href="{{ url('/') }}" target="_blank" class="brand__link">
        <div class="brand__row">
            <p class="brand__title">JeoIP</p>
        </div>
    </a>
    <p class="brand__subtitle">{{ __('messages.brand.subtitle') }}</p>
</div>
