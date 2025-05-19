@extends('layouts.Admin.master')

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header ">
            <h2 class="h4">Tambah Bidang Perusahaan</h2>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bidangperusahaan.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Nama Bidang Perusahaan :</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection
