@extends('layouts.Member.master-black')

@section('content')
<div class="container mt-7rem mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Card Wrapper for Edit Profile -->
            <div class="card shadow-lg border-0 rounded-xl overflow-hidden" style="border-radius: 20px;">
                <div class="row g-0">
                    <!-- Left Section: Visual Elements -->
                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center justify-content-center p-5 h-100 position-relative">
                            <div class="profile-background position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #6e8efb 0%, #4563df 100%); z-index: 1;"></div>
                            
                            <div class="position-relative text-center z-index-2" style="z-index: 2;">
                                <div class="avatar-container mb-4">
                                    <div class="edit-avatar rounded-circle d-flex align-items-center justify-content-center mx-auto position-relative">
                                        <div class="avatar-border position-absolute w-100 h-100 rounded-circle"></div>
                                        <div class="avatar-inner rounded-circle bg-white text-primary d-flex align-items-center justify-content-center">
                                            <i class="fa fa-user-edit" style="font-size: 70px;"></i>
                                        </div>
                                        <div class="avatar-glow position-absolute w-100 h-100 rounded-circle"></div>
                                    </div>
                                </div>
                                
                                <h3 class="fw-bold text-white mb-3">Edit Profil Anda</h3>
                                <p class="text-white-50 mb-4">Perbarui informasi profil Anda untuk tetap terhubung dengan kami</p>
                                
                                <div class="edit-steps mt-5">
                                    <div class="step active d-flex align-items-center mb-3">
                                        <div class="step-number bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;">1</div>
                                        <div class="step-text text-white">Isi data diri</div>
                                    </div>
                                    <div class="step d-flex align-items-center mb-3">
                                        <div class="step-number bg-white-50 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;">2</div>
                                        <div class="step-text text-white">Simpan perubahan</div>
                                    </div>
                                    <div class="step d-flex align-items-center">
                                        <div class="step-number bg-white-50 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;">3</div>
                                        <div class="step-text text-white">Nikmati layanan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Section: Form -->
                    <div class="col-md-8 bg-white">
                        <!-- Card Header (Mobile only) -->
                        <div class="card-header bg-primary text-white text-center py-4 d-md-none">
                            <i class="fa fa-edit fa-2x mb-2"></i>
                            <h3 class="mb-0">Edit Profil Anda</h3>
                        </div>
                        
                        <!-- Card Body -->
                        <div class="card-body p-5">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                                    <i class="fa fa-exclamation-triangle me-2"></i>{{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <h4 class="mb-4 border-bottom pb-3 text-primary profile-section-title d-none d-md-block">
                                <i class="fa fa-user-edit me-2"></i>Edit Informasi Profil
                            </h4>

                            <form method="POST" action="{{ route('profile.update') }}" class="profile-edit-form" id="profileForm">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-4 form-floating-group">
                                    <label for="name" class="form-label fw-bold"><i class="fa fa-user text-primary me-2"></i>Nama</label>
                                    <div class="input-group form-floating-wrapper">
                                        <span class="input-group-text border-0"><i class="fa fa-user text-primary"></i></span>
                                        <input type="text" class="form-control ps-2 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap">
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback d-block mt-1"><i class="fa fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4 form-floating-group">
                                    <label for="email" class="form-label fw-bold"><i class="fa fa-envelope text-primary me-2"></i>Email</label>
                                    <div class="input-group form-floating-wrapper">
                                        <span class="input-group-text border-0"><i class="fa fa-envelope text-primary"></i></span>
                                        <input type="email" class="form-control ps-2 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan alamat email">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block mt-1"><i class="fa fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4 form-floating-group">
                                    <label for="nama_perusahaan" class="form-label fw-bold"><i class="fa fa-building text-primary me-2"></i>Nama Perusahaan</label>
                                    <div class="input-group form-floating-wrapper">
                                        <span class="input-group-text border-0"><i class="fa fa-building text-primary"></i></span>
                                        <input type="text" class="form-control ps-2 @error('nama_perusahaan') is-invalid @enderror" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $user->nama_perusahaan) }}" placeholder="Masukkan nama perusahaan">
                                    </div>
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback d-block mt-1"><i class="fa fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4 form-floating-group">
                                    <label for="bidang_perusahaan" class="form-label fw-bold"><i class="fa fa-briefcase text-primary me-2"></i>Bidang Perusahaan</label>
                                    <div class="input-group form-floating-wrapper">
                                        <span class="input-group-text border-0"><i class="fa fa-briefcase text-primary"></i></span>
                                        <select class="form-select ps-2 @error('bidang_perusahaan') is-invalid @enderror" id="bidang_perusahaan" name="bidang_perusahaan">
                                            <option value="">Pilih Bidang Perusahaan</option>
                                            @foreach($bidangPerusahaan as $bidang)
                                                <option value="{{ $bidang->id }}" {{ (old('bidang_perusahaan', $user->bidang_id) == $bidang->id) ? 'selected' : '' }}>
                                                    {{ $bidang->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('bidang_perusahaan')
                                        <div class="invalid-feedback d-block mt-1"><i class="fa fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4 form-floating-group">
                                    <label for="no_telp" class="form-label fw-bold"><i class="fa fa-phone text-primary me-2"></i>Nomor Telepon</label>
                                    <div class="input-group form-floating-wrapper">
                                        <span class="input-group-text border-0"><i class="fa fa-phone text-primary"></i></span>
                                        <input type="text" class="form-control ps-2 @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" placeholder="Masukkan nomor telepon">
                                    </div>
                                    @error('no_telp')
                                        <div class="invalid-feedback d-block mt-1"><i class="fa fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4 form-floating-group">
                                    <label for="alamat" class="form-label fw-bold"><i class="fa fa-map-marker-alt text-primary me-2"></i>Alamat</label>
                                    <div class="input-group form-floating-wrapper">
                                        <span class="input-group-text border-0 align-items-start pt-2"><i class="fa fa-map-marker-alt text-primary"></i></span>
                                        <textarea class="form-control ps-2 @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat', $user->alamat) }}</textarea>
                                    </div>
                                    @error('alamat')
                                        <div class="invalid-feedback d-block mt-1"><i class="fa fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                                    <a href="{{ route('profile.show') }}" class="btn btn-light btn-lg px-4 py-2 rounded-pill shadow-sm cancel-btn">
                                        <i class="fa fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow submit-btn">
                                        <span class="btn-text"><i class="fa fa-save me-2"></i>Simpan Perubahan</span>
                                        <span class="btn-loader d-none">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Menyimpan...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Additional margin top for container */
    .mt-7rem {
        margin-top: 7rem !important;
    }
    
    /* Form floating effect */
    .form-floating-wrapper {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid #e0e6f3;
    }
    
    .form-floating-wrapper:focus-within {
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.2);
        border-color: #4e73df;
        transform: translateY(-3px);
    }
    
    .form-floating-wrapper .form-control,
    .form-floating-wrapper .form-select {
        border: none;
        background-color: #f8f9fc;
        transition: all 0.3s ease;
        height: 50px;
    }
    
    .form-floating-wrapper textarea.form-control {
        height: auto;
        min-height: 100px;
    }
    
    .form-floating-wrapper .input-group-text {
        background-color: #f8f9fc;
        width: 50px;
        justify-content: center;
    }
    
    /* Form label animation */
    .form-label {
        position: relative;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
        display: inline-block;
    }
    
    .form-label:after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: #4e73df;
        transition: width 0.3s ease;
    }
    
    .form-floating-group:focus-within .form-label:after {
        width: 100%;
    }
    
    /* Avatar styling */
    .edit-avatar {
        width: 150px;
        height: 150px;
        transition: all 0.5s ease;
    }
    
    .avatar-inner {
        width: 130px;
        height: 130px;
        transition: all 0.3s ease;
        z-index: 3;
    }
    
    .avatar-border {
        border: 3px solid rgba(255,255,255,0.3);
        animation: rotate 10s linear infinite;
        z-index: 2;
    }
    
    .avatar-glow {
        background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
        opacity: 0;
        transition: opacity 0.5s ease;
        z-index: 1;
    }
    
    .edit-avatar:hover {
        transform: scale(1.05);
    }
    
    .edit-avatar:hover .avatar-inner {
        transform: scale(1.1);
    }
    
    .edit-avatar:hover .avatar-glow {
        opacity: 0.6;
    }
    
    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    
    /* Step animation */
    .step {
        opacity: 0.7;
        transition: all 0.3s ease;
    }
    
    .step.active {
        opacity: 1;
    }
    
    /* Section title with animated underline */
    .profile-section-title {
        position: relative;
        display: inline-block;
        margin-bottom: 1.5rem;
    }
    
    .profile-section-title:after {
        content: '';
        position: absolute;
        width: 50%;
        transform: scaleX(0);
        height: 2px;
        bottom: -10px;
        left: 0;
        background-color: #4e73df;
        transform-origin: bottom right;
        transition: transform 0.5s ease-out;
    }
    
    .profile-section-title:hover:after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }
    
    /* Button styling */
    .submit-btn {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        background: linear-gradient(45deg, #4e73df, #6e8efb);
    }
    
    .submit-btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
    }
    
    .submit-btn:hover:before {
        left: 100%;
    }
    
    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .cancel-btn {
        transition: all 0.3s ease;
    }
    
    .cancel-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    
    /* Profile background animation */
    .profile-background {
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }
    
    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate form fields on page load
        const formControls = document.querySelectorAll('.form-control, .form-select');
        formControls.forEach((control, index) => {
            control.style.opacity = '0';
            control.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                control.style.transition = 'all 0.5s ease';
                control.style.opacity = '1';
                control.style.transform = 'translateY(0)';
            }, 100 + (index * 100));
        });
        
        // Update active step based on form field focus
        const formFields = document.querySelectorAll('.form-control, .form-select');
        const steps = document.querySelectorAll('.step');
        
        formFields.forEach(field => {
            field.addEventListener('focus', () => {
                steps[0].classList.add('active');
                steps[1].classList.remove('active');
                steps[2].classList.remove('active');
            });
        });
        
        // Handle form submission and track changed fields
        const form = document.getElementById('profileForm');
        const submitBtn = document.querySelector('.submit-btn');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                submitBtn.querySelector('.btn-text').classList.add('d-none');
                submitBtn.querySelector('.btn-loader').classList.remove('d-none');
                submitBtn.disabled = true;
                
                // Update step animation
                steps[0].classList.remove('active');
                steps[1].classList.add('active');
                
                // Track which fields were changed
                const originalValues = {
                    name: '{{ $user->name }}',
                    email: '{{ $user->email }}',
                    nama_perusahaan: '{{ $user->nama_perusahaan }}',
                    bidang_perusahaan: '{{ $user->bidang_id }}',
                    no_telp: '{{ $user->no_telp }}',
                    alamat: '{{ $user->alamat }}'
                };
                
                const formData = new FormData(form);
                const changedFields = [];
                
                if (formData.get('name') !== originalValues.name) changedFields.push('name');
                if (formData.get('email') !== originalValues.email) changedFields.push('email');
                if (formData.get('nama_perusahaan') !== originalValues.nama_perusahaan) changedFields.push('nama_perusahaan');
                if (formData.get('bidang_perusahaan') !== originalValues.bidang_perusahaan) changedFields.push('bidang_perusahaan');
                if (formData.get('no_telp') !== originalValues.no_telp) changedFields.push('no_telp');
                if (formData.get('alamat') !== originalValues.alamat) changedFields.push('alamat');
                
                // Store changed fields in session storage
                sessionStorage.setItem('updatedFields', JSON.stringify(changedFields));
                
                // Submit the form after a short delay to show loading state
                setTimeout(() => {
                    form.submit();
                }, 800);
            });
        }
        
        // Add confetti effect for the submit button hover
        const submitBtnEl = document.querySelector('.submit-btn');
        if (submitBtnEl) {
            submitBtnEl.addEventListener('mouseenter', function() {
                // Update step animation on hover
                steps[0].classList.remove('active');
                steps[1].classList.add('active');
            });
            
            submitBtnEl.addEventListener('mouseleave', function() {
                // Revert step animation when not hovering
                if (!document.activeElement || !document.activeElement.classList.contains('form-control')) {
                    steps[0].classList.add('active');
                    steps[1].classList.remove('active');
                }
            });
        }
    });
</script>
@endsection