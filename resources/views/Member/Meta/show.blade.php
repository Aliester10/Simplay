@extends('layouts.Member.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header mb-5 py-5" style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .1)), url('{{ asset('assets/img/announcementt.jpg') }}') center center no-repeat; background-size: cover; height: 300px;">
        <div class="container">
            <h1 class="display-3 text-white mb-3 animated slideInDown">{{ $meta->title }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{ $meta->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->

    <!-- Meta Content Section Start -->
    <div class="container mt-5 mb-5">
        <!-- Meta Title -->
        <h1 class="mb-4">{{ $meta->title }}</h1>

        <!-- Card for Meta Content -->
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <div class="content-wrapper">
                    {!! $meta->content !!}
                </div>
                <!-- Display the creation date -->
                <p class="text-muted mt-3">Created on: {{ $meta->created_at->format('d F Y') }}</p>
            </div>
        </div>
    </div>
    <!-- Meta Content Section End -->

@endsection

@section('styles')
    <!-- Custom Styles for Meta Page -->
    <style>
        .card {
            border-radius: 0.5rem;
        }

        .content-wrapper {
            padding: 1.5rem;
            border: 1px solid #e2e6ea;
            border-radius: 0.5rem;
            background-color: #f8f9fa;
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
        }

        .card-body {
            padding: 2rem;
        }

        .breadcrumb-item a {
            color: white;
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #f8c146;
        }

        @media (max-width: 767.98px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
@endsection
