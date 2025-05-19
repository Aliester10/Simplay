@extends('layouts.Member.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid page-header mb-5 py-5"
    style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .1)), url('{{ asset('assets/img/product.jpg') }}') center center no-repeat; background-size: cover; height: 300px;">
    <div class="container">
        <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('messages.products') }}</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">{{ __('messages.home') }}</a>
                </li>
                <li class="breadcrumb-item text-white active" aria-current="page">{{ __('messages.products') }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Header End -->

<div class="container mt-5">
    <div class="row">
        <!-- Sidebar Start -->
        <div class="col-lg-3">
            <h4 class="mb-4 text-dark font-weight-bold text-center">{{ __('messages.category_product') }}</h4>
            <ul class="list-group mb-4 shadow-sm">
                @foreach ($kategori as $kat)
                    <li class="list-group-item border-0 rounded text-center py-3 mb-2 shadow-sm"
                        style="cursor: pointer; background-color: {{ $selectedCategory && $selectedCategory->id == $kat->id ? '#6196FF' : '#f8f9fa' }}; transition: background-color 0.3s ease, color 0.3s ease;"
                        onmouseover="this.style.backgroundColor='#6196FF'; this.style.color='#fff';"
                        onmouseout="this.style.backgroundColor='{{ $selectedCategory && $selectedCategory->id == $kat->id ? '#6196FF' : '#f8f9fa' }}'; this.style.color='{{ $selectedCategory && $selectedCategory->id == $kat->id ? '#fff' : '#000' }}';"
                        onclick="window.location.href='{{ route('filterByCategory', $kat->id) }}'">
                        <strong>{{ $kat->nama }}</strong>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- Sidebar End -->

        <!-- Main Content Start -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between mb-4">
                <div class="col-lg-6">
                    <form method="POST" action="{{ url('products/search') }}" class="d-flex align-items-center">
                        @csrf
                        <input type="text" name="keyword" id="find" placeholder="{{ __('messages.search') }}"
                            style="flex-grow: 1; padding: 12px; border: none; border-radius: 10px; background-color: #eee;" />
                        <button type="submit" class="btn btn-primary ms-2 px-4"
                            style="margin-left: 10px; padding: 16px; border: none; border-radius: 10px; background-color: #3CBEEE; color: white;">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <select class="form-select w-25 border-0 bg-light shadow-sm">
                    <option selected>{{ __('messages.sort_by') }}</option>
                    <option value="1">{{ __('messages.newest') }}</option>
                    <option value="2">{{ __('messages.latest') }}</option>
                </select>
            </div>

            <!-- Pesan Alert Sukses -->
            <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert"
                style="display: none;">
                <span id="success-text"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="row">
                @foreach ($produks as $produk)
                                <div class="col-md-4 mb-4">
                                    <div class="card product-card border-0 shadow-sm"
                                        style="overflow: hidden; transition: transform 0.3s ease; border-radius: 10px; height: 400;">
                                        <a href="{{ route('product.show', $produk->id) }}">
                                            <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                                class="card-img-top" alt="{{ $produk->nama }}"
                                                style="object-fit: contain; height: 250; transition: transform 0.3s ease;">
                                        </a>
                                        <div class="card-body text-center">
                                            @php
                                                $name = $produk->nama;
                                                $limitedName = strlen($name) > 22 ? substr($name, 0, 22) . '..' : $name;
                                            @endphp
                                            <h5 class="card-title text-dark font-weight-bold">{{ $limitedName }}</h5>
                                            <a href="{{ route('product.show', $produk->id) }}"
                                                class="btn btn-outline-primary rounded-pill px-4 py-2 mt-3"
                                                style="transition: background-color 0.3s ease; border-color: #6196FF; color:#6196FF;">
                                                View Product →
                                            </a>
                                            <!-- Form untuk Distributor -->
                                            @if (auth()->user() && auth()->user()->type === 'distributor')
                                                <form action="{{ route('quotations.add_to_cart') }}" method="POST"
                                                    class="d-flex justify-content-center align-items-center add-to-cart-form">
                                                    @csrf
                                                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                                    <input type="number" name="quantity" min="1" value="1"
                                                        class="form-control form-control-sm me-2" style="width: 70px;">
                                                    <button type="submit" class="btn btn-primary btn-sm px-3">Tambah</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>
        </div>
        <!-- Main Content End -->
    </div>
</div>
@endsection

<script>
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah pengiriman form biasa
            const formData = new FormData(this);
            const url = this.action;
            fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Menampilkan pesan sukses di halaman
                        const successMessage = document.getElementById('success-message');
                        const successText = document.getElementById('success-text');
                        successText.textContent = data.message;
                        successMessage.style.display = 'block';
                        // Perbarui badge jumlah keranjang jika ada
                        const cartCount = document.getElementById('cart-count');
                        if (cartCount) {
                            cartCount.textContent = parseInt(cartCount.textContent) + parseInt(
                                formData.get('quantity'));
                        }
                        // Sembunyikan pesan setelah 3 detik
                        setTimeout(() => {
                            successMessage.style.display = 'none';
                        }, 3000);
                    } else {
                        // Menampilkan pesan error
                        alert(data.message || 'Terjadi kesalahan.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>

<!-- Additional Custom CSS -->
<style>
    /* General layout adjustments */
    .container-fluid.bg-breadcrumb {
        background-size: cover;
        background-position: center;
        color: #fff;
    }

    /* Product cards */
    .product-card {
        border-radius: 12px;
        background-color: #fff;
        transition: all 0.3s ease-in-out;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1);
    }

    /* Button styles */
    .btn-outline-primary {
        border: 2px solid #007bff;
        color: #007bff;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* Image hover effects */
    .product-card img {
        transition: transform 0.3s ease;
    }

    .product-card:hover img {
        transform: scale(1.05);
    }

    /* Breadcrumbs */
    .breadcrumb-item a {
        color: #333;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    /* Custom Typography */
    h1,
    h3,
    h5 {
        font-family: 'Montserrat', sans-serif;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
</style>

