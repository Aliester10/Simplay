@extends('layouts.Member.master')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Wrapper for Edit Profil -->
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-light text-dark text-center py-4 rounded-top">
                    <h2 class="mb-0">Edit Profil</h2>
                </div>
                <div class="card-body p-5">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form for Editing Profile -->
                    <form action="{{ auth()->user()->type === 'member' ? route('profile.update') : route('distributor.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center text-dark">Informasi Profil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-dark">Nama:</td>
                                    <td>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Email:</td>
                                    <td>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Nama Perusahaan:</td>
                                    <td>
                                        <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan', $user->nama_perusahaan) }}"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Bidang Perusahaan:</td>
                                    <td>
                                        <select class="form-control" id="bidang_perusahaan" name="bidang_perusahaan" required>
                                            <option value="" disabled selected>-- Pilih Bidang Perusahaan --</option>
                                            @foreach ($bidangPerusahaan as $bidang)
                                                <option value="{{ $bidang->id }}" {{ $user->bidang_id == $bidang->id ? 'selected' : '' }}>
                                                    {{ $bidang->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Nomor Telepon:</td>
                                    <td>
                                        <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $user->no_telp) }}"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Alamat:</td>
                                    <td>
                                        <textarea name="alamat" class="form-control">{{ old('alamat', $user->alamat) }}</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="text-end">
                            <button type="submit" class="btn-primary px-4 py-2 rounded-pill shadow-sm transition-all duration-300 hover:bg-primary">Perbaharui Profil</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center bg-light py-4 rounded-bottom">
                    @if (auth()->check())
                        <a href="{{ auth()->user()->type === 'member' ? route('profile.show') : route('distributor.profile.show') }}" 
                           class="btn btn-outline-primary px-4 py-2 rounded-pill shadow-sm transition-all duration-300 hover:bg-primary">
                           Kembali ke Profil
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
