@php($questions = trans('messages.faq.questions'))
@php($answers = trans('messages.faq.answers'))

<div class="faq">
    <div class="faq__header">
        <x-mdi-arrow-top-left class="section-arrow" />
        <p class="faq__title">{{ __('messages.faq.title') }}</p>
    </div>
    <div class="faq__list">
        @foreach ($questions as $i => $question)
            <p class="faq-item__question">{{ $question }}</p>
            <p class="faq-item__answer">{{ $answers[$i] ?? '' }}</p>
        @endforeach
    </div>
</div>
