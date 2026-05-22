@props(['location'])

<div class="ip-information">
    <p class="ip-information__title">{{ __('messages.ip.info.title') }}</p>

    <div class="ip-information__head">
        <p class="ip-information__ip">{{ $location->ip }}</p>
        <span class="ip-information__btn">{{ __('messages.ip.info.btn') }}</span>
    </div>

    <div class="ip-information__items">
        <div class="ip-information-item">
            <p class="ip-information-item__title">{{ __('messages.ip.info.location') }}</p>
            <div class="ip-information-item__body">
                <x-mdi-map-marker-outline class="ip-information-item__icon" />
                <p class="ip-information-item__value">{{ $location->city }} / {{ $location->country }}</p>
            </div>
        </div>
        <div class="ip-information-item">
            <p class="ip-information-item__title">{{ __('messages.ip.info.subnet') }}</p>
            <div class="ip-information-item__body">
                <x-mdi-television class="ip-information-item__icon" />
                <p class="ip-information-item__value">{{ $location->subnet }}</p>
            </div>
        </div>
    </div>
</div>
