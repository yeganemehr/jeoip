@php
$dir = app()->getLocale() == 'fa' ? 'rtl' : 'ltr';
@endphp
<div class="links">
    <p class="links__title">{{ __('messages.links.title') }}</p>
    @foreach (['dnj' => 'https://dnj.co.ir', 'jey' => 'https://jeyserver.com', 'webshot' => 'https://web-shot.ir', 'jeodns' => 'https://jeodns.com'] as $key => $href)
        <a href="{{ $href }}" target="_blank" class="link">
            @if ($dir === 'rtl')
                <x-mdi-chevron-left class="link__icon" />
            @else
                <x-mdi-chevron-right class="link__icon" />
            @endif
            <p class="link__text">{{ __('messages.links.' . $key) }}</p>
        </a>
    @endforeach
</div>
