@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage Career Positions</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Career Positions</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-briefcase me-1"></i> All Positions
            </div>
            <a href="{{ route('Admin.Career.Positions.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add New Position
            </a>
        </div>
        <div class="card-body">
            <table id="positionsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Applications</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($positions as $position)
                        <tr>
                            <td>{{ $position->title }}</td>
                            <td><span class="badge bg-info">{{ $position->category }}</span></td>
                            <td>
                                @if($position->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('Admin.Career.Applications.index', ['position_id' => $position->id]) }}">
                                    {{ $position->applications_count }} Applications
                                </a>
                            </td>
                            <td>{{ $position->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('Admin.Career.Positions.edit', $position) }}" class="btn btn-sm btn-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('Admin.Career.Positions.toggle', $position) }}" method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $position->is_active ? 'btn-warning' : 'btn-success' }} me-2" 
                                                title="{{ $position->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="fas {{ $position->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                        </button>
                                    </form>
                                    
                                    @if($position->applications_count == 0)
                                        <form action="{{ route('Admin.Career.Positions.destroy', $position) }}" method="post" class="d-inline position-delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this position?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No positions found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#positionsTable').DataTable({
            responsive: true
        });
    });
</script>
@endpush
@endsection