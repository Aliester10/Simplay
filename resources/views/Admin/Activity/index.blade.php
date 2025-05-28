@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="h4">Aktivitas</h1>
            <a href="{{ route('admin.activity.create') }}" class="btn btn-primary">Tambah Aktivitas Baru</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Gambar</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <td>
                                    <div id="carousel-{{ $activity->id }}" class="carousel slide" data-bs-ride="carousel" style="width: 100px;">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="{{ asset('images/'.$activity->image) }}" class="d-block w-100" alt="{{ $activity->title }}" style="height: 60px; object-fit: cover;">
                                            </div>
                                            @foreach($activity->images as $image)
                                                <div class="carousel-item">
                                                    <img src="{{ asset('images/'.$image->image) }}" class="d-block w-100" alt="{{ $activity->title }}" style="height: 60px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                        @if($activity->images->count() > 0)
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $activity->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $activity->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $activity->date->format('d-m-Y') }}</td>
                                <td>{{ $activity->title }}</td>
                                <td>{{ Str::limit($activity->description, 50) }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.activity.edit', $activity) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{ route('admin.activity.show', $activity) }}" class="btn btn-sm btn-info">Lihat</a>
                                        <form action="{{ route('admin.activity.destroy', $activity) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus aktivitas ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection