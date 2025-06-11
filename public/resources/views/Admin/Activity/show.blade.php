@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4>{{ $activity->title }}</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div id="activityImageCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#activityImageCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                @foreach($activity->images as $index => $image)
                                    <button type="button" data-bs-target="#activityImageCarousel" data-bs-slide-to="{{ $index + 1 }}" aria-label="Slide {{ $index + 2 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('images/'.$activity->image) }}" class="d-block w-100" alt="{{ $activity->title }}" style="height: 400px; object-fit: cover;">
                                </div>
                                @foreach($activity->images as $image)
                                    <div class="carousel-item">
                                        <img src="{{ asset('images/'.$image->image) }}" class="d-block w-100" alt="{{ $activity->title }}" style="height: 400px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            @if($activity->images->count() > 0)
                            <button class="carousel-control-prev" type="button" data-bs-target="#activityImageCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#activityImageCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            @endif
                        </div>
                    </div>
                    <p><strong>Tanggal :</strong> {{ $activity->date->format('d M Y') }}</p>
                    <p><strong>Deskripsi :</strong></p>
                    <p>{{ $activity->description }}</p>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.activity.index') }}" class="btn btn-primary">Kembali ke Aktivitas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection