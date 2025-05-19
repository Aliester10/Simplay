@extends('layouts.Member.master')

@section('content')
    <!-- Activity 2 Start -->
    <div id="act-1" class="container-fluid appointment py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-12 wow fadeInLeft" data-wow-delay="0.2">
                    <div class="section-title text-start">
                        <h1 class="display-4 mb-4">{{ $activity->title }}</h1>
                        <p class="mb-4"
                            style="
                                font-size: 0.875rem;
                                color: #6c757d;
                                margin: 0;
                                line-height: 1.5;
                                overflow: hidden;
                                white-space: normal;
                                word-wrap: break-word;
                                text-align: justify;
                            ">
                            <i class="fa fa-calendar-alt text-primary"></i>
                            {{ $activity->date->format('d M Y') }}
                        </p>
                        <div class="row g-4">
                            <div class="col-sm-12">
                                <div class="video h-100">
                                    <img src="{{ asset('images/' . $activity->image) }}"
                                        class="img-fluid rounded w-100 h-100"
                                        style="object-fit: cover; margin-bottom: 20px;" alt="">
                                </div>
                            </div>
                        </div>
                        <p class="mb-4"
                            style="
                                font-size: 0.875rem;
                                color: #6c757d;
                                margin: 0;
                                line-height: 1.5;
                                text-align: justify;
                                margin-top: 20px; /* Jarak antara gambar dan deskripsi */
                            ">
                            {{ $activity->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
