@extends('layouts.Admin.master')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header">
                <h1 class="h4">Tambah Merek/Pengguna Baru</h1>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="gambar">Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                        @error('gambar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="type">Tipe</label>
                        <select name="type" class="form-control">
                            {{-- <option value="brand">Merek</option> --}}
                            <option value="principal">Merek</option>
                            <option value="partner">Pengguna</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- <div class="form-group mb-3">
                        <label for="url">URL (Opsional)</label>
                        <input type="text" name="url" class="form-control" value="{{ old('url') }}">
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nama">Nama (Opsional)</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <button type="submit" class="btn btn-primary">Buat Merek/Pengguna</button>
                </form>
            </div>
        </div>
    </div>
@endsection
