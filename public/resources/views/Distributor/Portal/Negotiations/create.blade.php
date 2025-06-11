@extends('layouts.Member.master')
@section('content')

<!-- Header Start -->
<div class="container mt-5"></div>
<h1 class="text-center mb-4">Buat Negosiasi</h1>
<ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
    <li class="breadcrumb-item active text-primary">Buat Negosiasi</li>
</ol>
<!-- Header End -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-4 border-0 bg-light">
                <div class="card-body">
                    <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #333;">
                        Negotiate Quotation #{{ $quotation->quotation_number }}
                    </h2>
                    <form action="{{ route('distributor.quotations.negotiations.store', $quotation->id) }}" method="POST">
                        @csrf

                        <!-- Notes Field -->
                        <div class="form-group mb-4">
                            <label for="notes" class="form-label" style="font-weight: bold; color: #555;">Notes</label>
                            <textarea class="form-control px-3 py-2 border border-secondary" id="notes" name="notes" rows="4" placeholder="Add any additional notes..." style="resize: none; background-color: #f8f9fa;"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-primary px-4">
                                <i class="fas fa-paper-plane me-2"></i>Submit Negotiation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
