@props(['location', 'fixed' => false])

<div class="map {{ $fixed ? 'map--fixed' : 'map--inline' }}"
     data-map
     data-fixed="{{ $fixed ? '1' : '0' }}"
     data-lat="{{ $location->latitude }}"
     data-lng="{{ $location->longitude }}"
     data-marker="{{ Vite::asset('resources/assets/marker.png') }}"></div>