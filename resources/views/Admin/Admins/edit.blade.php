@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0">
        <div class="card-header">
            <h2>Edit Member</h2>
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
            <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" id="name" name="name"
                        class="form-control shadow-sm @error('name') is-invalid @enderror" value="{{ $admin->name }}"
                        required>
                    <div class="invalid-feedback">
                        @error('name') {{ $message }} @else Nama lengkap wajib diisi. @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email"
                        class="form-control shadow-sm @error('email') is-invalid @enderror" value="{{ $admin->email }}"
                        required>
                    <div class="invalid-feedback">
                        @error('email') {{ $message }} @else Email harus valid dengan domain @gmail.com. @enderror
                    </div>
                </div>

                <!-- Password Fields -->
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password Baru :</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru :</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    <small class="text-danger" id="password_confirmation_error"></small>
                </div>


                <div class="text-start">
                    <button type="submit" class="btn btn-success">Perbaharui</button>
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>


                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const password = document.getElementById("password");
        const passwordConfirmation = document.getElementById("password_confirmation");
        const errorElement = document.getElementById("password_confirmation_error");

        passwordConfirmation.addEventListener("input", () => {
            if (password.value !== passwordConfirmation.value) {
                errorElement.textContent = "Password dan konfirmasi password tidak cocok.";
                passwordConfirmation.classList.add("is-invalid");
            } else {
                errorElement.textContent = "";
                passwordConfirmation.classList.remove("is-invalid");
            }
        });
    });
</script>
@endsection