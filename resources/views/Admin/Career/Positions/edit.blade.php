@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Position</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('Admin.Career.Positions.index') }}">Career Positions</a></li>
        <li class="breadcrumb-item active">Edit Position</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i> Position Details
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('Admin.Career.Positions.update', $position) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Position Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $position->title) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" disabled>Select category</option>
                                <option value="Engineering" {{ old('category', $position->category) == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                                <option value="Marketing" {{ old('category', $position->category) == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="Design" {{ old('category', $position->category) == 'Design' ? 'selected' : '' }}>Design</option>
                                <option value="Research" {{ old('category', $position->category) == 'Research' ? 'selected' : '' }}>Research</option>
                                <!-- Debug: Print category value -->
                                <!-- {{ $position->category }} -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $position->location) }}" required>
                            <div class="form-text">Where the job will be based (e.g., Jakarta, Remote, etc.)</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label">Employment Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="" disabled>Select employment type</option>
                                <option value="Full-time" {{ old('type', $position->type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('type', $position->type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ old('type', $position->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Internship" {{ old('type', $position->type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Freelance" {{ old('type', $position->type) == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="description" class="form-label">Job Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $position->description) }}</textarea>
                    <small class="form-text text-muted">Describe the responsibilities and duties for this position.</small>
                </div>

                <div class="mb-3">
                    <label for="responsibilities" class="form-label">Responsibilities</label>
                    <textarea class="form-control" id="responsibilities" name="responsibilities" rows="5" required>{{ old('responsibilities', $position->responsibilities) }}</textarea>
                    <div class="form-text">List the specific duties and responsibilities for this position.</div>
                </div>

                <div class="form-group mb-3">
                    <label for="requirements" class="form-label">Requirements <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="requirements" name="requirements" rows="5" required>{{ old('requirements', $position->requirements) }}</textarea>
                    <small class="form-text text-muted">List the qualifications, skills, and experience required for this position.</small>
                </div>

                <div class="form-group mb-3">
                    <label for="benefits" class="form-label">Benefits (Optional)</label>
                    <textarea class="form-control" id="benefits" name="benefits" rows="3">{{ old('benefits', $position->benefits) }}</textarea>
                    <small class="form-text text-muted">List any benefits and perks offered for this position.</small>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="salary_range" class="form-label">Salary Range (Optional)</label>
                            <input type="text" class="form-control" id="salary_range" name="salary_range" value="{{ old('salary_range', $position->salary_range) }}">
                            <small class="form-text text-muted">Example: "IDR 8,000,000 - 12,000,000" or "Competitive"</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="application_deadline" class="form-label">Application Deadline (Optional)</label>
                            <input type="date" class="form-control" id="application_deadline" name="application_deadline" value="{{ old('application_deadline', $position->application_deadline ? date('Y-m-d', strtotime($position->application_deadline)) : '') }}">
                        </div>
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ old('is_active', $position->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Active Position
                    </label>
                    <small class="form-text text-muted d-block">If checked, this position will be visible on the career page.</small>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Position</button>
                    <a href="{{ route('Admin.Career.Positions.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Debug in browser console
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Category value:', '{{ $position->category }}');
        
        // Form submission debug
        document.querySelector('form').addEventListener('submit', function(e) {
            // e.preventDefault(); // Uncomment to prevent form submission for testing
            console.log('Form submitted with category:', document.getElementById('category').value);
        });
    });
</script>
@endpush
@endsection