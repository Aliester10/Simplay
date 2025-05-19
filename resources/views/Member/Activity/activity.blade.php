@extends('layouts.Member.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header mb-5 py-5" style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .1)), url('{{ asset('assets/img/activity.jpg') }}') center center no-repeat; background-size: cover; height: 300px;">
        <div class="container">
            <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('messages.activity') }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{ __('messages.activity') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->

    <!-- Activity Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <!-- Navigation Section -->
            <div class="row mb-4">
                <!-- Showing X-Y of Z -->
                <div class="col-md-4 d-flex align-items-center">
                    <p class="mb-0">Menampilkan {{ $activities->firstItem() }} - {{ $activities->lastItem() }} dari
                        {{ $activities->total() }}</p>
                </div>
                <!-- Show per Page and Sort By -->
                <div class="col-md-8 d-flex justify-content-end align-items-center">
                    <div class="d-flex align-items-center">
                        <label for="sort-by" class="mb-0 me-4" style="display: inline-block; white-space: nowrap;">
                            Urut berdasarkan :
                        </label>
                        <select id="sort-by" class="form-select form-select-sm">
                            <option value="newest">Terbaru</option>
                            <option value="latest">Terlama</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Activity Content -->
            <div class="row g-4 justify-content-center">
                @foreach ($activities as $item)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="blog-item rounded"
                            style="box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 15px;">
                            <div class="blog-img">
                                <img src="{{ asset('images/' . $item->image) }}" class="img-fluid w-100" alt="Image"
                                    style="border-radius: 15px; width: 100%; height: 250px; object-fit: cover;">
                            </div>
                            <div class="blog-content p-4" style="flex-grow: 1;">
                                <div class="d-flex justify-content-between mb-4">
                                    <p class="mb-0 text-muted" style="font-size: 0.875rem;"><i
                                            class="fa fa-calendar-alt text-primary"></i> {{ $item->date->format('d M Y') }}
                                    </p>
                                </div>
                                <a href="" class="h4"
                                    style="font-weight: bold; color: #343a40; text-decoration: none;">{{ $item->title }}</a>
                                <p class="my-4"
                                    style="
                                    font-size: 0.875rem;
                                    color: #6c757d;
                                    margin: 0;
                                    line-height: 1.5;
                                    overflow: hidden;
                                    white-space: normal;
                                    word-wrap: break-word;
                                ">
    {{ Str::limit($item->description, 40) }}
</p>

                                <a href="{{ route('activity.show', $item->id) }}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-1"
                                    style="background-color: #007BFF; border: none;">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12">
                    {{ $activities->links() }} <!-- Menampilkan pagination -->
                </div>
            </div>
        </div>
    </div>
    <!-- Activity End -->
@endsection
