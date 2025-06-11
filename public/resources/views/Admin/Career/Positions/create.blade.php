@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Add New Position</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Add New</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus me-1"></i>
            Position Details
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

            <form action="{{ route('Admin.Career.Positions.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Position Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select a category</option>
                                <option value="Engineering" {{ old('category') == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                                <option value="Marketing" {{ old('category') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="Design" {{ old('category') == 'Design' ? 'selected' : '' }}>Design</option>
                                <option value="Research" {{ old('category') == 'Research' ? 'selected' : '' }}>Research</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                            <div class="form-text">Where the job will be based (e.g., Jakarta, Remote, etc.)</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label">Employment Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select employment type</option>
                                <option value="Full-time" {{ old('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ old('type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Internship" {{ old('type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Freelance" {{ old('type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Job Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                    <div class="form-text">Describe the overall job role and purpose.</div>
                </div>

                <div class="mb-3">
                    <label for="responsibilities" class="form-label">Responsibilities</label>
                    <textarea class="form-control" id="responsibilities" name="responsibilities" rows="5" required>{{ old('responsibilities') }}</textarea>
                    <div class="form-text">List the specific duties and responsibilities for this position.</div>
                </div>

                <div class="mb-3">
                    <label for="requirements" class="form-label">Requirements</label>
                    <textarea class="form-control" id="requirements" name="requirements" rows="5" required>{{ old('requirements') }}</textarea>
                    <div class="form-text">List the qualifications, skills, and experience required for this position.</div>
                </div>
                
                <div class="mb-3">
                    <label for="benefits" class="form-label">Benefits (Optional)</label>
                    <textarea class="form-control" id="benefits" name="benefits" rows="3">{{ old('benefits') }}</textarea>
                    <div class="form-text">List any benefits and perks offered for this position.</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="salary_range" class="form-label">Salary Range (Optional)</label>
                            <input type="text" class="form-control" id="salary_range" name="salary_range" value="{{ old('salary_range') }}">
                            <div class="form-text">Example: "IDR 8,000,000 - 12,000,000" or "Competitive"</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="application_deadline" class="form-label">Application Deadline (Optional)</label>
                            <input type="date" class="form-control" id="application_deadline" name="application_deadline" value="{{ old('application_deadline') }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active Position</label>
                    <div class="form-text">If checked, this position will be visible on the career page.</div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Create Position</button>
                    <a href="{{ route('Admin.Career.Positions.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Optional: Add rich text editor to description, responsibilities, requirements, and benefits fields
    // You can use libraries like CKEditor, TinyMCE, or Summernote
    document.addEventListener('DOMContentLoaded', function() {
        // If you have a rich text editor library loaded, initialize it here
        // Example for CKEditor (if available):
        // if (typeof CKEDITOR !== 'undefined') {
        //     CKEDITOR.replace('description');
        //     CKEDITOR.replace('responsibilities');
        //     CKEDITOR.replace('requirements');
        //     CKEDITOR.replace('benefits');
        // }
    });
</script>
@endpush
@endsection