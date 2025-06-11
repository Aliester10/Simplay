@extends('layouts.Member.master')

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Keranjang Permintaan Quotation</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
        <li class="breadcrumb-item active text-primary">Keranjang Permintaan Quotation</li>
    </ol>
</div>


<div class="container mt-5">


    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Button to Add More Products -->
    <div class="text-start mb-4">
        <div class="p-4 shadow-sm rounded bg-white">
            <a href="{{ url('/en/products') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Tambah Produk
            </a>
        

        <!-- Cart Table -->
        <div class="table-responsive">
            <h3 class="mt-5 text-center">Keranjang Permintaan Quotation</h3>
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Produk</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cartItems as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td class="text-center">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                    class="form-control d-inline-block update-quantity" style="width: 80px;"
                                    data-produk-id="{{ $item['produk_id'] }}">
                            </td>
                            <td class="text-center">
                                <form action="{{ route('quotations.cart.remove') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="produk_id" value="{{ $item['produk_id'] }}">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Keranjang kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Submit Quotation Button -->
    @if(count($cartItems) > 0)
        <form action="{{ route('quotations.submit') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="topik" class="form-label">Topik</label>
                <input type="text" name="topik" id="topik" class="form-control" placeholder="Masukkan topik permintaan">
            </div>
            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                <i class="fas fa-paper-plane me-2"></i>Ajukan Permintaan Quotation
            </button>
        </form>

    @endif
</div>
</div>
</div>


<!-- JavaScript for AJAX -->
<script>
    document.querySelectorAll('.update-quantity').forEach(input => {
        input.addEventListener('change', function () {
            const produkId = this.getAttribute('data-produk-id');
            const quantity = this.value;

            fetch('{{ route('quotations.cart.update') }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ produk_id: produkId, quantity: quantity })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Optional: Reload or update part of the page
                        console.log('Quantity updated successfully');
                    } else {
                        alert(data.message || 'Error updating quantity.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
@endsection