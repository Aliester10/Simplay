@extends('layouts.Member.master')

@section('content')
<!-- Header Start -->
<div class="container mt-5"></div>
<h1 class="text-center mb-4">Buat Purchase Order</h1>
<ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
    <li class="breadcrumb-item active text-primary">Buat Purchase Order</li>
</ol>
<!-- Header End -->


<div class="container mt-5">
    <div class="card shadow-lg p-4 ">
        <div class="card-body">
            <h2 class="text-start mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">
                Buat Purchase Order #{{ $quotation->quotation_number }}
            </h2>

            <form action="{{ route('quotations.store_po', $quotation->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!-- Input PO Number -->
                <div class="form-group mb-4">
                    <label for="po_number" class="form-label" style="font-weight: bold; color: #004d40;">PO
                        Number</label>
                    <input type="text" class="form-control  shadow-sm" id="po_number" name="po_number"
                        placeholder="Enter PO Number" required>
                </div>

                <!-- Upload PO File -->
                <div class="form-group mb-4">
                    <label for="file_path" class="form-label" style="font-weight: bold; color: #004d40;">Upload PO
                        File</label>
                    <input type="file" class="form-control  shadow-sm" id="file_path" name="file_path"
                        accept=".pdf,.doc,.docx" required>
                    <small class="form-text text-muted">Supported formats: PDF, DOC, DOCX</small>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-primary  shadow-sm">
                        <i class="fas fa-paper-plane me-2"></i>Buat Purchase Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection