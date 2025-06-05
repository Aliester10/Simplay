@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Applications</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Applications</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter Form -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter me-1"></i> Filter Applications
        </div>
        <div class="card-body">
            <form action="{{ route('Admin.Career.Applications.index') }}" method="get" class="row g-3">
                <div class="col-md-5">
                    <label for="position_id" class="form-label">Position</label>
                    <select class="form-select" id="position_id" name="position_id">
                        <option value="all">All Positions</option>
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}" {{ request('position_id') == $position->id ? 'selected' : '' }}>
                                {{ $position->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="all">All Statuses</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Applications 
            <span class="badge bg-primary">{{ $applications->count() }}</span>
        </div>
        <div class="card-body">
            <table id="applicationsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Applied Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td>{{ $application->name }}</td>
                            <td>{{ $application->email }}</td>
                            <td>{{ $application->position->title }}</td>
                            <td>
                                @php
                                    $statusClass = match($application->status) {
                                        'Pending' => 'bg-warning',
                                        'Diproses' => 'bg-info',
                                        'Ditolak' => 'bg-danger',
                                        'Diterima' => 'bg-success',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $application->status }}</span>
                            </td>
                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('Admin.Career.Applications.show', $application) }}" class="btn btn-sm btn-primary me-2" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('Admin.Career.Applications.cv', $application) }}" class="btn btn-sm btn-info" title="Download CV">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No applications found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="mt-4">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#applicationsTable').DataTable({
            paging: false,
            searching: false,
            info: false
        });
    });
</script>
@endpush
@endsection