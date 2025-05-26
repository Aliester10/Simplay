@extends('layouts.Member.master-black')

@section('content')
<div class="container mt-7rem mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card profile-card shadow-lg border-0 rounded-xl overflow-hidden" style="border-radius: 20px;">
                <!-- Success Animation Overlay (initially hidden) -->
                <div id="success-animation" class="position-absolute w-100 h-100 d-none" style="z-index: 1030; background: rgba(255,255,255,0.9);">
                    <div class="d-flex flex-column justify-content-center align-items-center h-100">
                        <div class="checkmark-circle">
                            <div class="checkmark draw"></div>
                        </div>
                        <h3 class="mt-4 text-success fw-bold animation-text">Profil Berhasil Diperbarui!</h3>
                    </div>
                </div>
                
                <div class="row g-0">
                    <!-- Profile Sidebar/Avatar Section -->
                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center p-5 h-100 position-relative profile-sidebar">
                            <div class="profile-background position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #6e8efb 0%, #4563df 100%); z-index: 1;"></div>
                            
                            <div class="position-relative text-center z-index-2" style="z-index: 2;">
                                <div class="avatar-container mb-4">
                                    <div class="profile-avatar rounded-circle d-flex align-items-center justify-content-center mx-auto position-relative">
                                        <div class="avatar-border position-absolute w-100 h-100 rounded-circle"></div>
                                        <div class="avatar-inner rounded-circle bg-white text-primary d-flex align-items-center justify-content-center">
                                            <i class="fa fa-user-circle" style="font-size: 80px;"></i>
                                        </div>
                                        <div class="avatar-glow position-absolute w-100 h-100 rounded-circle"></div>
                                    </div>
                                </div>
                                
                                <h3 class="fw-bold text-white mb-1 name-text">{{ $user->name }}</h3>
                                <p class="text-white-50 mb-3">{{ $user->bidangPerusahaan->name ?? 'Belum diatur' }}</p>
                                <div class="d-flex justify-content-center">
                                    @if (auth()->check())
                                        <a href="{{ auth()->user()->type === 'member' ? route('profile.edit') : route('distributor.profile.edit') }}" 
                                           class="btn btn-light px-4 py-2 rounded-pill shadow-sm edit-profile-btn">
                                           <i class="fa fa-edit me-2"></i>Edit Profil
                                        </a>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="profile-stat-cards position-relative mt-4 w-100" style="z-index: 2;">
                                <div class="card stat-card text-white p-3 mb-3 rounded-lg border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box me-3 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fa fa-building text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-white-50">Perusahaan</h6>
                                            <p class="mb-0">{{ $user->nama_perusahaan ?? 'Belum diatur' }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card stat-card text-white p-3 rounded-lg border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box me-3 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fa fa-phone text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-white-50">Kontak</h6>
                                            <p class="mb-0">{{ $user->no_telp ?? 'Belum diatur' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Profile Info Section -->
                    <div class="col-md-8 bg-white">
                        <div class="card-body p-5">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            <h4 class="mb-4 border-bottom pb-3 text-primary profile-section-title">
                                <i class="fa fa-info-circle me-2"></i>Informasi Profil
                            </h4>
                            
                            <div class="profile-info">
                                <div class="profile-info-item mb-4">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-5 col-lg-4 mb-2 mb-md-0">
                                            <div class="profile-info-label d-flex align-items-center">
                                                <div class="icon-box me-3 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                                    <i class="fa fa-user text-white"></i>
                                                </div>
                                                <span class="fw-bold text-dark">Nama</span>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-lg-8">
                                            <div class="profile-info-value py-2 px-3 rounded-pill bg-light border border-1 border-primary border-opacity-25 updated-field" data-field="name">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="profile-info-item mb-4">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-5 col-lg-4 mb-2 mb-md-0">
                                            <div class="profile-info-label d-flex align-items-center">
                                                <div class="icon-box me-3 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                                    <i class="fa fa-envelope text-white"></i>
                                                </div>
                                                <span class="fw-bold text-dark">Email</span>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-lg-8">
                                            <div class="profile-info-value py-2 px-3 rounded-pill bg-light border border-1 border-primary border-opacity-25 updated-field" data-field="email">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="profile-info-item mb-4">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-5 col-lg-4 mb-2 mb-md-0">
                                            <div class="profile-info-label d-flex align-items-center">
                                                <div class="icon-box me-3 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                                    <i class="fa fa-briefcase text-white"></i>
                                                </div>
                                                <span class="fw-bold text-dark">Bidang</span>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-lg-8">
                                            <div class="profile-info-value py-2 px-3 rounded-pill bg-light border border-1 border-primary border-opacity-25 updated-field" data-field="bidang_perusahaan">
                                                {{ $user->bidangPerusahaan->name ?? 'Belum diatur' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="profile-info-item mb-4">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-5 col-lg-4 mb-2 mb-md-0">
                                            <div class="profile-info-label d-flex align-items-center">
                                                <div class="icon-box me-3 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                                    <i class="fa fa-building text-white"></i>
                                                </div>
                                                <span class="fw-bold text-dark">Perusahaan</span>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-lg-8">
                                            <div class="profile-info-value py-2 px-3 rounded-pill bg-light border border-1 border-primary border-opacity-25 updated-field" data-field="nama_perusahaan">
                                                {{ $user->nama_perusahaan ?? 'Belum diatur' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="profile-info-item mb-4">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-5 col-lg-4 mb-2 mb-md-0">
                                            <div class="profile-info-label d-flex align-items-center">
                                                <div class="icon-box me-3 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                                    <i class="fa fa-phone text-white"></i>
                                                </div>
                                                <span class="fw-bold text-dark">Telepon</span>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-lg-8">
                                            <div class="profile-info-value py-2 px-3 rounded-pill bg-light border border-1 border-primary border-opacity-25 updated-field" data-field="no_telp">
                                                {{ $user->no_telp ?? 'Belum diatur' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="profile-info-item">
                                    <div class="row g-0">
                                        <div class="col-md-5 col-lg-4 mb-2 mb-md-0">
                                            <div class="profile-info-label d-flex align-items-center">
                                                <div class="icon-box me-3 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                                    <i class="fa fa-map-marker-alt text-white"></i>
                                                </div>
                                                <span class="fw-bold text-dark">Alamat</span>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-lg-8">
                                            <div class="profile-info-value py-3 px-3 rounded-3 bg-light border border-1 border-primary border-opacity-25 updated-field" data-field="alamat" style="min-height: 80px;">
                                                {{ $user->alamat ?? 'Belum diatur' }}
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
    </div>
</div>

<style>
    /* Additional margin top for container */
    .mt-7rem {
        margin-top: 7rem !important;
    }

    /* Card styling */
    .profile-card {
        transition: all 0.5s ease;
        overflow: hidden;
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
    
    /* Profile sidebar styling */
    .profile-sidebar {
        background-color: #6e8efb;
    }
    
    /* Profile info item styling */
    .profile-info-value {
        transition: all 0.3s ease;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .profile-info-item:hover .profile-info-value {
        transform: translateX(5px);
        background-color: #e6eeff !important;
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.1);
    }
    
    /* Avatar styling */
    .profile-avatar {
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
    
    .profile-avatar:hover {
        transform: scale(1.05);
    }
    
    .profile-avatar:hover .avatar-inner {
        transform: scale(1.1);
    }
    
    .profile-avatar:hover .avatar-glow {
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
    
    /* Stat card styling */
    .stat-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
        transform: translateY(0);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.2);
    }
    
    /* Edit button styling */
    .edit-profile-btn {
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }
    
    .edit-profile-btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: 0.5s;
        z-index: -1;
    }
    
    .edit-profile-btn:hover:before {
        left: 100%;
    }
    
    .edit-profile-btn:hover {
        background-color: #ffffff;
        color: #4e73df;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
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
    
    /* Success animation styling */
    .checkmark-circle {
        width: 100px;
        height: 100px;
        position: relative;
        display: inline-block;
        vertical-align: top;
    }
    
    .checkmark-circle .checkmark {
        border-radius: 5px;
    }
    
    .checkmark-circle .checkmark.draw:after {
        animation-delay: 100ms;
        animation-duration: 1s;
        animation-timing-function: ease;
        animation-name: checkmark;
        transform: scaleX(-1) rotate(135deg);
        animation-fill-mode: forwards;
    }
    
    .checkmark-circle .checkmark:after {
        opacity: 0;
        height: 50px;
        width: 25px;
        transform-origin: left top;
        border-right: 8px solid #4CAF50;
        border-top: 8px solid #4CAF50;
        content: '';
        left: 25px;
        top: 50px;
        position: absolute;
    }
    
    @keyframes checkmark {
        0% {
            height: 0;
            width: 0;
            opacity: 0;
        }
        20% {
            height: 0;
            width: 25px;
            opacity: 1;
        }
        40% {
            height: 50px;
            width: 25px;
            opacity: 1;
        }
        100% {
            height: 50px;
            width: 25px;
            opacity: 1;
        }
    }
    
    .animation-text {
        opacity: 0;
        animation: fadeIn 1s ease forwards;
        animation-delay: 0.5s;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Field update highlight animation */
    @keyframes highlightUpdate {
        0% {
            background-color: #e6eeff;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.3);
        }
        70% {
            background-color: #e6eeff;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.3);
        }
        100% {
            background-color: #f8f9fc;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
    }
    
    .highlight-update {
        animation: highlightUpdate 2s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if there's a success message and show the success animation
        const successAlert = document.querySelector('.alert-success');
        const successAnimation = document.getElementById('success-animation');
        
        if (successAlert && successAnimation) {
            // Show success animation
            successAnimation.classList.remove('d-none');
            
            // Hide the animation after 2 seconds
            setTimeout(function() {
                successAnimation.style.transition = 'opacity 0.5s ease';
                successAnimation.style.opacity = '0';
                
                setTimeout(function() {
                    successAnimation.classList.add('d-none');
                    successAnimation.style.opacity = '1';
                    
                    // Get the updated fields from session storage and highlight them
                    const updatedFields = JSON.parse(sessionStorage.getItem('updatedFields') || '[]');
                    highlightUpdatedFields(updatedFields);
                    
                    // Clear the session storage
                    sessionStorage.removeItem('updatedFields');
                }, 500);
            }, 2000);
        }
        
        // Function to highlight updated fields
        function highlightUpdatedFields(fields) {
            if (!fields || !fields.length) return;
            
            fields.forEach(field => {
                const fieldElement = document.querySelector(`.updated-field[data-field="${field}"]`);
                if (fieldElement) {
                    fieldElement.classList.add('highlight-update');
                }
            });
        }
        
        // Check if there are updated fields in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const updatedFields = urlParams.get('updated');
        if (updatedFields) {
            highlightUpdatedFields(updatedFields.split(','));
        }
    });
</script>
@endsection