@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2>Monitoring untuk {{ $produk->produk->nama }}</h2>
                </div>
                <div class="card-body">
                    <h3 class="mb-4">Detail Produk</h3>
                    <div class="mb-3">
                        <table class="table table-bordered mb-4">
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $produk->produk->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pembelian</th>
                                    <td>{{ $produk->pembelian }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="mb-4">Data Monitoring</h3>
                    @if ($monitoring)
                    <table class="table table-borderless mb-3" style="width: auto;">
                        <tbody>
                            <tr>
                                <th scope="row">Status Barang :</th>
                                <td>{{ $monitoring->status_barang }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kondisi Terakhir Produk :</th>
                                <td>{{ $monitoring->kondisi_terakhir_produk }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @else
                        <p class="text-muted">Tidak ada data monitoring tersedia untuk produk ini.</p>
                    @endif

                    <div class="mb-4">
                        @if ($monitoring)
                            <a href="{{ route('admin.monitoring.edit', $monitoring->id) }}" class="btn btn-warning">Edit Data Monitoring</a>
                        @else
                            <a href="{{ route('admin.monitoring.create', ['userProdukId' => $produk->id]) }}" class="btn btn-success">Buat Data Monitoring</a>
                        @endif
                    </div>

                    <h3 class="mb-4">Inspections - Maintenance Produk</h3>
                    <a href="{{ route('admin.inspeksi.create', ['userProdukId' => $produk->id]) }}" class="btn btn-primary mb-4">Buat Teknisi</a>

                    @if ($inspeksi->isNotEmpty())
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Penanggung Jawab</th>
                                    <th>Waktu</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inspeksi as $item)
                                    <tr>
                                        <td>{{ $item->pic }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <a href="{{ route('admin.inspeksi.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('admin.inspeksi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.inspeksi.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this inspection?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Tidak ada teknisi tersedia untuk produk ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('admin.monitoring.index') }}" class="btn btn-secondary">Kembali ke Daftar Monitoring</a>

</div>
@endsection
