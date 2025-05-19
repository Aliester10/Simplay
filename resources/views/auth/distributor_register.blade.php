@extends('layouts.Member.master2') 
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded">
                <div class="card-header text-center" style="background-color: #add8e6; color: #004085;">
                    <h4 class="mb-0 fw-bold">Distributor Registration</h4>
                </div>
                <div class="card-body px-4 py-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('distributors.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form Fields -->
                        <div class="mb-3 d-flex align-items-center">
                            <label for="name" class="form-label me-3" style="width: 150px;">Name</label>
                            <input type="text" id="name" name="name" class="form-control shadow-sm" required>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="email" class="form-label me-3" style="width: 150px;">Email</label>
                            <input type="email" id="email" name="email" class="form-control shadow-sm" required>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="password" class="form-label me-3" style="width: 150px;">Password</label>
                            <input type="password" id="password" name="password" class="form-control shadow-sm" required>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="password_confirmation" class="form-label me-3" style="width: 150px;">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control shadow-sm" required>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="no_telp" class="form-label me-3" style="width: 150px;">Phone Number</label>
                            <input type="text" id="no_telp" name="no_telp" class="form-control shadow-sm" required>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="alamat" class="form-label me-3" style="width: 150px;">Address</label>
                            <input type="text" id="alamat" name="alamat" class="form-control shadow-sm" required>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="nama_perusahaan" class="form-label me-3" style="width: 150px;">Company Name</label>
                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control shadow-sm" required>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="pic" class="form-label me-3" style="width: 150px;">PIC</label>
                            <input type="text" id="pic" name="pic" class="form-control shadow-sm" required>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="nomor_telp_pic" class="form-label me-3" style="width: 150px;">PIC's Phone Number</label>
                            <input type="text" id="nomor_telp_pic" name="nomor_telp_pic" class="form-control shadow-sm" required>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="akta" class="form-label me-3" style="width: 150px;">Upload Akta</label>
                            <input type="file" id="akta" name="akta" class="form-control shadow-sm" required>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="nib" class="form-label me-3" style="width: 150px;">Upload NIB</label>
                            <input type="file" id="nib" name="nib" class="form-control shadow-sm" required>
                        </div>
                        <button type="submit" class="btn btn-light text-primary w-100 mt-4 shadow-sm fw-bold">
                            Register as Distributor
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
