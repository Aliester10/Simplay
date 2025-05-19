@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h1 class="card-title">Produk untuk {{ $user->name }}</h1>
                            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">

        @if($user->userProduk->isEmpty())
            <p>Tidak ada produk ditemukan untuk pengguna ini.</p>
        @else
                    <tr>
                        <th>Nama Produk</th>
                        <th>Tanggal Pembelian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->userProduk as $userProduk)
                        <tr>
                            <td>{{ $userProduk->produk->nama }}</td>
                            <td>{{ $userProduk->pembelian }}</td>
                            <td>
                                <a href="{{ route('monitoring.detail', $userProduk->id) }}" class="btn btn-primary btn-sm">Tampilkan Detail Monitoring </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
                </div>
                        </div>
                    </div>
                </div>
</div>
@endsection
