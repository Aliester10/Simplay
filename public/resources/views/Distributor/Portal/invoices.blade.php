@extends('layouts.Member.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Invoice</h3>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
                <li class="breadcrumb-item active text-primary">Invoice</li>
            </ol>
        </div>
    </div>
    <!-- Header End --><br><br>
    <!-- Content Start -->
    <div class="container">
        <h2>Pengelolaan Invoice</h2>
        <p>Di sini Anda dapat melihat dan mengelola invoice yang diterbitkan berdasarkan PO yang telah dikirim.</p>
        <!-- Tambahkan daftar invoice atau detail invoice di sini -->
    </div>
    <!-- Content End -->
@endsection