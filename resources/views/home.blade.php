@extends('layouts.app')

@section('background')
    @if ($location !== null)
        <x-map :fixed="true" :$location />
    @endif
@endsection

@section('content')
    <div class="card ip-card">
        <x-brand :row="true" :icon-size="38" />

        @if ($location === null)
            <div class="ip-card__error-box">
                <p class="ip-card__error">{{ __('messages.ip.card.error') }}</p>
                <a href="{{ url()->current() }}" class="ip-card__retry">{{ __('messages.ip.card.retry') }}</a>
            </div>
            <x-ip-api />
            <x-faq />
        @else
            <x-ip-information :$location />
            <x-ip-data-table :$location :$userAgent />
            <x-map :fixed="false" :$location />
            <x-ip-api />
            <x-faq />
        @endif
    </div>
@endsection
