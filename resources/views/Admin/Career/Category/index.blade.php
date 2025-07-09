@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Daftar Kategori Career</h3>
                    <a href="{{ route('Admin.Career.Category.create') }}" class="btn btn-primary">Tambah Kategori Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->category }}</td>
                                        <td>
                                            <a href="{{ route('Admin.Career.Category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('Admin.Career.Category.destroy', $category->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
