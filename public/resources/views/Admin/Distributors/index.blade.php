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
                    <h1 class="card-title">Daftar Distributor</h1>
                </div>
                <div class="container mt-5">


                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body p-0">

                        <form action="{{ route('admin.distributors.index') }}" method="GET" class="mb-4">
                            <div class="flex space-x-4">
                                <input type="text" name="name" placeholder="Search by Name"
                                    value="{{ request('name') }}" class="px-4 py-2 border border-gray-300 rounded-md">
                                <input type="text" name="email" placeholder="Search by Email"
                                    value="{{ request('email') }}" class="px-4 py-2 border border-gray-300 rounded-md">
                                <input type="text" name="company" placeholder="Search by Company"
                                    value="{{ request('company') }}"
                                    class="px-4 py-2 border border-gray-300 rounded-md">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md">Search</button>
                            </div>
                            </form>



                            @if($distributors->isEmpty() && !request('search'))

                                <div class="alert alert-info m-3">
                                    <i class="fas fa-info-circle me-2"></i>Belum ada distributor yang mendaftar.
                                </div>
                            @else

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Company</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse($distributors as $key => $distributor)
                                                <tr>

                                                    <td>{{ $distributors->firstItem() + $key }}</td>
                                                    <td>{{ $distributor->name }}</td>
                                                    <td>{{ $distributor->email }}</td>
                                                    <td>{{ $distributor->nama_perusahaan }}</td>
                                                    <td>
                                                        <span class="badge 
                                                                                                @if($distributor->verified) bg-success 
                                                                                                @else bg-warning @endif">
                                                            {{ $distributor->verified ? 'Approved' : 'Pending' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if(!$distributor->verified)
                                                            <form
                                                                action="{{ route('admin.distributors.approve', $distributor->id) }}"
                                                                method="POST" style="display:inline-block;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    <i class="fas fa-check me-1"></i>Approve
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-secondary btn-sm" disabled>
                                                                <i class="fas fa-check-circle me-1"></i>Approved
                                                            </button>
                                                        @endif
                                                        <a href="{{ route('admin.distributors.show', $distributor->id) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye me-1"></i> View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <!-- Pagination -->
                                    @if($distributors->isNotEmpty())
                                        <div class="d-flex justify-content-center mt-3">
                                            {{ $distributors->withQueryString()->links() }}
                                        </div>
                                    @endif
                            @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection