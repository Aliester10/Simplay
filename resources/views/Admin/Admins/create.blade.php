@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Buat Akun Member</h2>
                </div>
                <div class="card-body">
                    <!-- Tampilkan Error -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" id="name" name="name"
                                class="form-control shadow-sm @error('name') is-invalid @enderror"
                                placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                            <div class="invalid-feedback">
                                @error('name') {{ $message }} @else Nama lengkap wajib diisi. @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control shadow-sm @error('email') is-invalid @enderror"
                                placeholder="Masukkan email" value="{{ old('email') }}" required>
                            <div class="invalid-feedback">
                                @error('email') {{ $message }} @else Email harus valid dengan domain @gmail.com.
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Opsional)</label>
                            <input type="password" id="password" name="password"
                                class="form-control shadow-sm @error('password') is-invalid @enderror"
                                placeholder="Masukkan password">
                            <small class="form-text text-muted">Kosongkan jika ingin menggunakan password
                                otomatis.</small>
                            <div class="invalid-feedback">
                                @error('password') {{ $message }} @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        @endsection