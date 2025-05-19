@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        <h1>Daftar Tiket Layanan</h1>
                    </div>
                </div>


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

                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body p-0">
                        <!-- Search Form -->
                        <form action="{{ route('admin.tickets.index') }}" method="GET" class="p-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari tiket..."
                                    value="{{ request()->input('search') }}">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Layanan</th>
                                                <th>Keterangan</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($tickets as $key => $ticket)
                                                <tr>
                                                    <td>{{ $tickets->firstItem() + $key }}</td>
                                                    <!-- Adjust numbering with pagination -->
                                                    <td>{{ $ticket->jenis_layanan }}</td>
                                                    <td>{{ Str::limit($ticket->keterangan_layanan, 30) }}</td>
                                                    <td>{{ $ticket->tgl_pengajuan }}</td>
                                                    <td>
                                                        <span class="badge 
                                                        @if($ticket->status == 'open') bg-success 
                                                        @elseif($ticket->status == 'progress') bg-warning 
                                                        @else bg-secondary @endif">
                                                            {{ ucfirst($ticket->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.tickets.show', $ticket->id_after_sales) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye me-1"></i> View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada tiket ditemukan.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <!-- Pagination Links -->
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $tickets->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection