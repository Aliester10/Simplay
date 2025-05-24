@extends('layouts.Member.master2')
@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow border-0 rounded">
                <div class="card-header text-center" style="background-color: #add8e6; color: #004085;">
                    <h4 class="mb-0 fw-bold">Distributor Registration</h4>
                </div>
                <div class="card-body px-3 px-md-4 py-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('distributors.register.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form Fields -->
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label">Name</label>
                            <div class="col-md-8">
                                <input type="text" id="name" name="name" class="form-control shadow-sm @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-8">
                                <input type="email" id="email" name="email" class="form-control shadow-sm @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label">Password</label>
                            <div class="col-md-8">
                                <input type="password" id="password" name="password" class="form-control shadow-sm @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password_confirmation" class="col-md-4 col-form-label">Confirm Password</label>
                            <div class="col-md-8">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control shadow-sm" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="no_telp" class="col-md-4 col-form-label">Phone Number</label>
                            <div class="col-md-8">
                                <input type="text" id="no_telp" name="no_telp" class="form-control shadow-sm @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" required>
                                @error('no_telp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="alamat" class="col-md-4 col-form-label">Address</label>
                            <div class="col-md-8">
                                <input type="text" id="alamat" name="alamat" class="form-control shadow-sm @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" required>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama_perusahaan" class="col-md-4 col-form-label">Company Name</label>
                            <div class="col-md-8">
                                <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control shadow-sm @error('nama_perusahaan') is-invalid @enderror" value="{{ old('nama_perusahaan') }}" required>
                                @error('nama_perusahaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="pic" class="col-md-4 col-form-label">PIC</label>
                            <div class="col-md-8">
                                <input type="text" id="pic" name="pic" class="form-control shadow-sm @error('pic') is-invalid @enderror" value="{{ old('pic') }}" required>
                                @error('pic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nomor_telp_pic" class="col-md-4 col-form-label">PIC's Phone Number</label>
                            <div class="col-md-8">
                                <input type="text" id="nomor_telp_pic" name="nomor_telp_pic" class="form-control shadow-sm @error('nomor_telp_pic') is-invalid @enderror" value="{{ old('nomor_telp_pic') }}" required>
                                @error('nomor_telp_pic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="akta" class="col-md-4 col-form-label">Upload Akta</label>
                            <div class="col-md-8">
                                <input type="file" id="akta" name="akta" class="form-control shadow-sm @error('akta') is-invalid @enderror" required>
                                @error('akta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nib" class="col-md-4 col-form-label">Upload NIB</label>
                            <div class="col-md-8">
                                <input type="file" id="nib" name="nib" class="form-control shadow-sm @error('nib') is-invalid @enderror" required>
                                @error('nib')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-light text-primary w-100 shadow-sm fw-bold">
                                Register as Distributor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Add responsive styles */
    @media (max-width: 767px) {
        .col-form-label {
            padding-bottom: 0;
            margin-bottom: 0.25rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .row {
            margin-bottom: 0.75rem;
        }
        
        label {
            font-weight: 500;
        }
    }
</style>
@endsection