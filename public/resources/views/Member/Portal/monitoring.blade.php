@extends('layouts.Member.master')

@section('content')
<!-- Services Start -->
<div class="container mt-5">
    <h1 class="text-center mb-4">{{ __('messages.monitoring') }}</h1>

    @if($userProduks->isEmpty())
        <div class="alert alert-warning text-center">
            Anda belum memiliki produk untuk di monitor.
        </div>
    @else
        <div class="row">
            @foreach($userProduks as $userProduk)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset($userProduk->produk->images->first()->gambar ?? 'assets/img/default.jpg') }}" class="card-img-top img-fluid" alt="{{ $userProduk->produk->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $userProduk->produk->nama }}</h5>
                        <p class="card-text">{{ Str::limit($userProduk->produk->deskripsi, 100) }}</p>

                        <!-- Display Monitoring Info -->
                        @if($userProduk->monitoring)
                            <h6>Monitoring</h6>
                            <p>Status Barang: {{ $userProduk->monitoring->status_barang }}</p>
                            <p>Kondisi Terakhir: {{ $userProduk->monitoring->kondisi_terakhir_produk }}</p>
                        @else
                            <p>No monitoring data available.</p>
                        @endif
                    <a href="{{ route('portal.monitoring.detail', $userProduk->id) }}" class="btn btn-primary mt-2">Detail Produk</a>
                </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
<!-- Services End -->
@endsection
