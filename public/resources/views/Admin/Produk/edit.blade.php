@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2>Edit Produk : {{ $produk->nama }}</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs mb-4" id="productTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Umum</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="user-manual-tab" data-toggle="tab" href="#user-manual" role="tab" aria-controls="user-manual" aria-selected="false">Panduan Penggunaan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Dokumen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="brosur-tab" data-toggle="tab" href="#brosur" role="tab" aria-controls="brosur" aria-selected="false">Brosur</a>
                            </li>
                        </ul>

                        <!-- Tabs Content -->
                        <div class="tab-content">
                            <!-- General Tab -->
                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                                <div class="card p-3 mb-4">
                                    <div class="form-group mb-3">
                                        <label for="nama">Nama Produk :</label>
                                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $produk->nama) }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="merk">Merk Produk :</label>
                                        <input type="text" name="merk" class="form-control" value="{{ old('merk', $produk->merk) }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="link">Link E-Katalog Produk :</label>
                                        <input type="text" name="link" class="form-control" value="{{ old('link', $produk->link) }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="deskripsi">Deskripsi Produk :</label>
                                        <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="spesifikasi">Spesifikasi Produk :</label>
                                        <textarea name="spesifikasi" class="form-control" required>{{ old('spesifikasi', $produk->spesifikasi) }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
    <label for="harga">Harga Produk :</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Rp</span>
        </div>
        <input type="number" name="harga" class="form-control" value="{{ old('harga', $produk->harga) }}" required>
    </div>
</div>

                                    <div class="form-group mb-3">
                                        <label for="kategori_id">Kategori :</label>
                                        <select name="kategori_id" class="form-control" required>
                                            @foreach ($kategori as $kategoris)
                                                <option value="{{ $kategoris->id }}" {{ old('kategori_id', $produk->kategori_id) == $kategoris->id ? 'selected' : '' }}>
                                                    {{ $kategoris->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="gambar">Gambar Produk :</label>
                                        <input type="file" name="gambar[]" class="form-control" multiple>
                                        <small class="form-text text-muted">Unggah beberapa gambar produk jika diperlukan.</small>

                                        <!-- Display current images -->
                                        @if($produk->images)
                                            <div class="mt-2">
                                                @foreach($produk->images as $image)
                                                    <div class="d-inline-block text-center mb-3">
                                                        <img src="{{ asset($image->gambar) }}" alt="Gambar Produk" style="max-width: 100px; margin-right: 10px;">
                                                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"> Hapus
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- User Manual Tab -->
                            <div class="tab-pane fade" id="user-manual" role="tabpanel" aria-labelledby="user-manual-tab">
                                <div class="card p-3 mb-4">
                                    <div class="form-group mb-3">
                                        <label for="video">Video Tutorial (MP4, AVI, MKV)</label>
                                        <input type="file" class="form-control" name="video[]" id="video" accept="video/*" multiple>
                                        <small class="form-text text-muted">Unggah beberapa video tutorial produk jika diperlukan.</small>

                                        <!-- Display current videos -->
                                        @if($produk->videos)
                                            <div class="mt-2">
                                                @foreach($produk->videos as $video)
                                                    <div class="d-inline-block text-center mb-3">
                                                        <video width="200" controls>
                                                            <source src="{{ asset($video->video) }}" type="video/mp4">
                                                                Browser Anda tidak mendukung tag video.
                                                        </video>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="user_manual">Panduan Penggunaanan (PDF/DOC)</label>
                                        <input type="file" class="form-control" name="user_manual" id="user_manual">
                                        @if($produk->user_manual)
                                            <a href="{{ asset($produk->user_manual) }}" target="_blank" class="btn btn-link">Lihat Panduan Penggunaanan</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Documents Tab -->
                            <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                                <div class="card p-3 mb-4">
                                    <div class="form-group mb-3">
                                        <label for="document_certification_pdf">Sertifikasi Dokumen PDF:</label>
                                        <input type="file" class="form-control" name="document_certification_pdf[]" id="document_certification_pdf" accept=".pdf" multiple>
                                        <small class="form-text text-muted">Unggah beberapa Sertifikasi Dokumen PDF jika diperlukan.</small>

                                        <!-- Display current PDFs -->
                                        @if($produk->documentCertificationsProduk && $produk->documentCertificationsProduk->count())
                                            <ul>
                                                @foreach($produk->documentCertificationsProduk as $document)
                                                    <li>
                                                        <a href="{{ asset($document->pdf) }}" target="_blank">Lihat PDF</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted">Tidak ada Sertifikasi Dokumen PDF yang tersedia.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Brosur Tab -->
                            <div class="tab-pane fade" id="brosur" role="tabpanel" aria-labelledby="brosur-tab">
                                <div class="card p-3 mb-4">
                                    <div class="form-group mb-3">
                                        <label for="file">Brosur (PDF/Image)</label>
                                        <input type="file" class="form-control" id="file" name="file[]" multiple>
                                        @error('file')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        @if($produk->brosur && $produk->brosur->count())
                                            <ul>
                                                @foreach($produk->brosur as $document)
                                                    <li>
                                                        <a href="{{ asset($document->file) }}" target="_blank">Lihat Brosur</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted">Tidak ada brosur yang tersedia.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success mt-3">Perbaharui Produk</button>
                        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection