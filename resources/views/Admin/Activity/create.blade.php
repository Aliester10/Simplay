@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header ">
            <h1 class="h4">Tambah Aktivitas Baru</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.activity.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="images" class="form-label">Gambar (Bisa pilih lebih dari satu)</label>
                    <input type="file" class="form-control" id="images" name="images[]" required multiple>
                    <small class="text-muted">Gambar pertama akan menjadi gambar utama aktivitas.</small>
                    <div class="mt-2">
                        <div id="imagePreview" class="row"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview images before upload
    document.getElementById('images').addEventListener('change', function(event) {
        var imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';
        
        for (var i = 0; i < event.target.files.length; i++) {
            var col = document.createElement('div');
            col.className = 'col-md-3 mb-3';
            
            var card = document.createElement('div');
            card.className = 'card';
            
            var img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.className = 'card-img-top';
            img.style.height = '150px';
            img.style.objectFit = 'cover';
            
            var cardBody = document.createElement('div');
            cardBody.className = 'card-body p-2 text-center';
            
            var text = document.createElement('small');
            text.className = i === 0 ? 'text-primary' : 'text-muted';
            text.textContent = i === 0 ? 'Gambar Utama' : 'Gambar Tambahan';
            
            cardBody.appendChild(text);
            card.appendChild(img);
            card.appendChild(cardBody);
            col.appendChild(card);
            imagePreview.appendChild(col);
        }
    });
</script>
@endpush
@endsection