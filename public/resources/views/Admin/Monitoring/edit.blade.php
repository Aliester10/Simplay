@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <div class="row">
<div class="col-md-12">
    <div class="card">

        <div class="card-header">
            <h1>Edit Data Monitoring untuk {{ $userProduk->produk->nama }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.monitoring.update', $monitoring->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Status Barang input -->
                <div class="form-group">
                    <label for="status_barang">Status Barang</label>
                    <input type="text" name="status_barang" id="status_barang" class="form-control" value="{{ $monitoring->status_barang }}" required>
                </div>

                <!-- Kondisi Terakhir Produk input -->
                <div class="form-group">
                    <label for="kondisi_terakhir_produk">Kondisi Terakhir Produk</label>
                    <input type="text" name="kondisi_terakhir_produk" id="kondisi_terakhir_produk" class="form-control" value="{{ $monitoring->kondisi_terakhir_produk }}" required>
                </div>

                <!-- Submit Button -->
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary">Perbaharui Data Monitoring</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection
