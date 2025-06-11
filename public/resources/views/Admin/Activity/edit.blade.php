@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header">
            <h1 class="h4">Edit Activitas</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.activity.update', $activity) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label">Gambar Utama</label>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ asset('images/'.$activity->image) }}" alt="{{ $activity->title }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                <div class="card-body p-2 text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="replace_main_image" id="replace_main_image" value="1">
                                        <label class="form-check-label" for="replace_main_image">
                                            Ganti
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 mb-3" id="main_image_upload" style="display: none;">
                            <div class="input-group">
                                <input type="file" class="form-control" id="main_image" name="main_image">
                                <label class="input-group-text" for="main_image">Upload</label>
                            </div>
                            <div id="mainImagePreview" class="mt-2"></div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Gambar Tambahan</label>
                    <div class="row">
                        @foreach($activity->images as $image)
                            <div class="col-md-3 mb-3 image-container" id="image-container-{{ $image->id }}">
                                <div class="card">
                                    <img src="{{ asset('images/'.$image->image) }}" alt="{{ $activity->title }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body p-2 text-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete-{{ $image->id }}">
                                            <label class="form-check-label" for="delete-{{ $image->id }}">
                                                Hapus
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Tambah Gambar Baru</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                    <div class="mt-2">
                        <div id="imagePreview" class="row"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $activity->date->format('Y-m-d') }}" required>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $activity->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ $activity->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Toggle main image upload
    document.getElementById('replace_main_image').addEventListener('change', function() {
        document.getElementById('main_image_upload').style.display = this.checked ? 'block' : 'none';
    });

    // Preview main image before upload
    document.getElementById('main_image').addEventListener('change', function(event) {
        var mainImagePreview = document.getElementById('mainImagePreview');
        mainImagePreview.innerHTML = '';
        
        if (event.target.files.length > 0) {
            var img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[0]);
            img.className = 'img-fluid img-thumbnail';
            img.style.maxHeight = '150px';
            mainImagePreview.appendChild(img);
        }
    });

    // Preview additional images before upload
    document.getElementById('images').addEventListener('change', function(event) {
        var imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';
        
        for (var i = 0; i < event.target.files.length; i++) {
            var col = document.createElement('div');
            col.className = 'col-md-3 mb-3';
            
            var img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.className = 'img-fluid img-thumbnail';
            img.style.height = '150px';
            img.style.objectFit = 'cover';
            
            col.appendChild(img);
            imagePreview.appendChild(col);
        }
    });
</script>
@endpush
@endsection