@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Application Details</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.career.applications.index') }}">Applications</a></li>
        <li class="breadcrumb-item active">Application Details</li>
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

    <div class="row">
        <!-- Applicant Information -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <i class="fas fa-user me-1"></i> Applicant Information
                    </div>
                    <a href="{{ route('admin.career.applications.cv', $application) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-download"></i> Download CV
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Full Name</h5>
                            <p class="mb-0">{{ $application->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Email Address</h5>
                            <p class="mb-0">
                                <a href="mailto:{{ $application->email }}">{{ $application->email }}</a>
                            </p>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Applied Position</h5>
                            <p class="mb-0">{{ $application->position->title }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Application Date</h5>
                            <p class="mb-0">{{ $application->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5>Position Details</h5>
                            <div class="card card-body bg-light mb-3">
                                <h6>Description</h6>
                                <p class="mb-3">{!! nl2br(e($application->position->description)) !!}</p>
                                
                                <h6>Requirements</h6>
                                <p class="mb-0">{!! nl2br(e($application->position->requirements)) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Status Update -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-tasks me-1"></i> Application Status
                </div>
                <div class="card-body">
                    <div class="current-status mb-4">
                        <h5>Current Status</h5>
                        @php
                            $statusClass = match($application->status) {
                                'Pending' => 'bg-warning',
                                'Diproses' => 'bg-info',
                                'Ditolak' => 'bg-danger',
                                'Diterima' => 'bg-success',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <div class="d-inline-block">
                            <span class="badge {{ $statusClass }} fs-6">{{ $application->status }}</span>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.career.applications.status', $application) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="status" class="form-label">Update Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Pending" {{ $application->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Diproses" {{ $application->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Ditolak" {{ $application->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="Diterima" {{ $application->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                    </form>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-envelope me-1"></i> Contact Applicant
                </div>
                <div class="card-body">
                    <a href="mailto:{{ $application->email }}" class="btn btn-info w-100 mb-3">
                        <i class="fas fa-envelope me-1"></i> Send Email
                    </a>
                    
                    <a href="{{ route('admin.career.applications.index', ['position_id' => $application->position_id]) }}" class="btn btn-secondary w-100">
                        <i class="fas fa-list me-1"></i> View Similar Applications
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection