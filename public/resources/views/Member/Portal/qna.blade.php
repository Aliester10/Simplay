@extends('layouts.Member.master')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ __('messages.qna') }}</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                @forelse($faqs as $faq)
                    <div class="mb-5">
                        <div class="accordion" id="qnaAccordion-{{ $faq->id }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false"
                                        aria-controls="collapse{{ $faq->id }}">
                                        {{ $faq->pertanyaan }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $faq->id }}"
                                    data-bs-parent="#qnaAccordion-{{ $faq->id }}">
                                    <div class="accordion-body">
                                        <p>{{ $faq->jawaban }}</p>
                                        @if ($faq->image)
                                            <!-- Check if there is an associated image -->
                                            <img src="{{ asset($faq->image) }}" alt="Image related to FAQ"
                                                class="img-fluid mt-3">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No FAQs available.</p>
                @endforelse
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
@endsection
