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
                    <h1 class="card-title">Daftar Member</h1>
                    <a href="{{ route('members.create') }}" class="btn btn-primary">Tambah Member</a>
                </div>

                <div class="card-body">
                    <!-- Formulir Pencarian -->
                    <form action="{{ route('members.index') }}" method="GET" class="mb-4">
                        <div class="flex space-x-4">
                            <!-- Name Search Field -->
                            <input type="text" name="name" placeholder="Search by Name" value="{{ request('name') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md">

                            <!-- Company Search Field -->
                            <input type="text" name="company" placeholder="Search by Company"
                                value="{{ request('company') }}" class="px-4 py-2 border border-gray-300 rounded-md">

                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Search</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Nomor Telepon</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->nama_perusahaan }}</td>
                                        <td>{{ $member->no_telp }}</td>
                                        <td>{{ $member->alamat }}</td>
                                        <td>
                                            <a href="{{ route('members.show', $member->id) }}"
                                                class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('members.edit', $member->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this member?');">Delete</button>
                                            </form>
                                            <a href="{{ route('members.add-products', $member->id) }}"
                                                class="btn btn-secondary btn-sm">Tambah Produk</a>
                                            <a href="{{ route('members.edit-products', $member->id) }}"
                                                class="btn btn-warning btn-sm">Edit Produk</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        @if ($members->lastPage() > 1)
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    {{-- Tombol Previous --}}
                                    @if ($members->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">&laquo; Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $members->previousPageUrl() }}" class="page-link"
                                                aria-label="Previous">&laquo; Previous</a>
                                        </li>
                                    @endif

                                    {{-- Nomor Halaman --}}
                                    @for ($i = 1; $i <= $members->lastPage(); $i++)
                                        <li class="page-item {{ $i == $members->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $members->url($i) }}" class="page-link">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Tombol Next --}}
                                    @if ($members->hasMorePages())
                                        <li class="page-item">
                                            <a href="{{ $members->nextPageUrl() }}" class="page-link" aria-label="Next">Next
                                                &raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">Next &raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .pagination {
        display: flex;
        justify-content: center;
        padding-left: 0;
        list-style: none;
    }

    .pagination .page-item {
        margin: 0 0.25rem;
    }

    .pagination .page-item .page-link {
        padding: 0.5rem 0.75rem;
        border: 1px solid #ddd;
        border-radius: 0;
        /* Hapus rounded */
        text-decoration: none;
        color: #007bff;
        transition: background-color 0.2s ease;
    }

    .pagination .page-item .page-link:hover {
        background-color: #007bff;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #f8f9fa;
    }

    .pagination .page-item .page-link {
        padding: 0.5rem 0.75rem;
        border: 1px solid #ddd;
        border-radius: 0 !important;
        text-decoration: none;
        color: #007bff;
        transition: background-color 0.2s ease;
    }
</style>

@endsection