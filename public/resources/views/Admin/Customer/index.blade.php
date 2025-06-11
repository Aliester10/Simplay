@extends('layouts.Admin.master')

@section('content')
    <!-- Customer Start -->
    <div id="customer" class="container-xxl py-5" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">{{ __('messages.our_customers') }}</h6>
                <h1 class="mb-5">{{ __('messages.customers') }}</h1>
            </div>
            @if ($customers->isNotEmpty())
                <div class="row gy-4">
                    @foreach ($customers as $key => $customer)
                        <div class="col-6 col-md-4 col-xl-2 text-center customer-item {{ $key >= 10 ? 'd-none' : '' }}">
                            <div class="bg-white px-4 py-3 px-md-6 py-md-4 px-lg-8 py-lg-5">
                                <img src="{{ asset($customer->gambar) }}" alt="{{ $customer->name }}" width="100%" height="80">
                                <h5 class="mt-2">{{ $customer->name }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($customers->count() > 10)
                    <div class="text-center mt-4">
                        <button id="show-more-customers" class="btn btn-primary">{{ __('messages.show_more') }}</button>
                        <button id="show-less-customers" class="btn btn-secondary d-none">{{ __('messages.show_less') }}</button>
                    </div>
                @endif
            @else
                <div class="text-center">
                    <p class="text-dark" style="letter-spacing: 2px; margin: 0;">
                        {{ __('messages.no_customers_available') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
    <!-- Customer End -->
@endsection
