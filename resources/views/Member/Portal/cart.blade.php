@extends('layouts.Member.master-black')

@section('content')
<div class="cart-page-wrapper container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Shopping Cart</h1>
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ol>
            </nav>
            
            <!-- Cart content -->
            @if(count($products) > 0)
                <div class="cart-content">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr class="cart-item" id="cart-item-{{ $product->id }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="cart-item-image me-3">
                                                @if($product->images->count() > 0)
                                                    <img src="{{ asset($product->images->first()->gambar) }}" alt="{{ $product->nama }}">
                                                @else
                                                    <img src="{{ asset('assets/img/default.jpg') }}" alt="{{ $product->nama }}">
                                                @endif
                                            </div>
                                            <div class="cart-item-details">
                                                <h5 class="mb-1"><a href="{{ route('product.show', $product->id) }}">{{ $product->nama }}</a></h5>
                                                <p class="text-muted mb-0">{{ $product->merk }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="cart-quantity-control">
                                            <button class="quantity-btn update-quantity" data-id="{{ $product->id }}" data-action="decrease">-</button>
                                            <input type="text" class="quantity-input" value="{{ $product->cartQuantity }}" min="1" readonly>
                                            <button class="quantity-btn update-quantity" data-id="{{ $product->id }}" data-action="increase">+</button>
                                        </div>
                                    </td>
                                    <td class="fw-bold">Rp {{ number_format($product->subtotal, 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger remove-from-cart" data-id="{{ $product->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Cart totals -->
                    <div class="cart-totals mt-4">
                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-3">Cart Totals</h4>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Subtotal</span>
                                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Shipping</span>
                                            <span>Free</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="fw-bold">Total</span>
                                            <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-success checkout-btn">
                                                Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart text-center py-5">
                    <i class="fas fa-shopping-cart fa-5x mb-4 text-muted"></i>
                    <h3>Your cart is empty</h3>
                    <p class="text-muted mb-4">Looks like you haven't added any products to your cart yet.</p>
                    <a href="{{ route('product.index') }}" class="btn btn-dark">Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- CSS styles for cart page -->
<style>
    .cart-page-wrapper {
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
        padding: 40px;
        margin-top: 5rem;
        margin-bottom: 30px;
    }
    
    .cart-item-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .cart-item-details h5 a {
        color: #333;
        text-decoration: none;
        transition: color 0.2s;
    }
    
    .cart-item-details h5 a:hover {
        color: #000;
    }
    
    .cart-quantity-control {
        display: flex;
        align-items: center;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        overflow: hidden;
        width: 120px;
    }
    
    .cart-quantity-control .quantity-btn {
        background: #f5f5f5;
        border: none;
        width: 35px;
        height: 35px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        transition: all 0.2s;
    }
    
    .cart-quantity-control .quantity-btn:hover {
        background: #e9e9e9;
    }
    
    .cart-quantity-control .quantity-input {
        width: 50px;
        text-align: center;
        border: none;
        padding: 8px 0;
        font-size: 16px;
        font-weight: 500;
        background: #fff;
    }
    
    .checkout-btn {
        padding: 12px;
        font-weight: 600;
    }
    
    .empty-cart {
        background-color: #f9f9f9;
        border-radius: 12px;
        padding: 80px 20px;
    }
    
    .empty-cart i {
        color: #ccc;
    }
    
    /* Animasi untuk halaman cart */
    .cart-item {
        transition: all 0.5s ease;
    }
    
    .cart-item.updating {
        position: relative;
        pointer-events: none;
    }
    
    .cart-item.updating::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 5;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        animation: fadeIn 0.3s forwards;
    }
    
    .cart-item.updating::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 30px;
        height: 30px;
        border: 3px solid rgba(0, 0, 0, 0.1);
        border-top: 3px solid #3498db;
        border-radius: 50%;
        z-index: 6;
        animation: spin 0.8s linear infinite;
    }
    
    .cart-item.updated {
        background-color: rgba(40, 167, 69, 0.1);
        transition: background-color 0.5s ease;
    }
    
    .cart-item.removing {
        overflow: hidden;
        transition: all 0.5s ease;
        position: relative;
        pointer-events: none;
    }
    
    .cart-item.removing::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(220, 53, 69, 0.1);
        z-index: 5;
        animation: fadeIn 0.3s forwards;
    }
    
    .quantity-changed-increase {
        animation: increaseEffect 0.5s ease;
    }
    
    .quantity-changed-decrease {
        animation: decreaseEffect 0.5s ease;
    }
    
    @keyframes increaseEffect {
        0% { color: #000; }
        50% { color: #28a745; transform: scale(1.2); }
        100% { color: #000; }
    }
    
    @keyframes decreaseEffect {
        0% { color: #000; }
        50% { color: #dc3545; transform: scale(1.2); }
        100% { color: #000; }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    .shake-button {
        animation: shake 0.5s ease;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-5px); }
        40%, 80% { transform: translateX(5px); }
    }
    
    .confirm-delete-box {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(3px);
    }
    
    .confirm-delete-box.show {
        opacity: 1;
    }
    
    .confirm-delete-inner {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
        transform: scale(0.9);
        transition: all 0.3s ease;
        text-align: center;
        max-width: 300px;
        width: 100%;
    }
    
    .confirm-delete-box.show .confirm-delete-inner {
        transform: scale(1);
    }
    
    .confirm-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 15px;
    }
    
    .total-updated {
        animation: totalUpdate 1s ease;
    }
    
    @keyframes totalUpdate {
        0% { color: #000; }
        50% { color: #28a745; font-size: 110%; }
        100% { color: #000; }
    }
    
    @media (max-width: 768px) {
        .cart-page-wrapper {
            padding: 20px;
        }
        
        .cart-item-image {
            width: 60px;
            height: 60px;
        }
        
        .cart-quantity-control {
            width: 100px;
        }
    }
</style>

<!-- JavaScript for cart functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update cart quantity
        const updateQuantityBtns = document.querySelectorAll('.update-quantity');
        if (updateQuantityBtns.length > 0) {
            updateQuantityBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const action = this.getAttribute('data-action');
                    const inputElement = this.parentElement.querySelector('.quantity-input');
                    const cartItem = this.closest('.cart-item');
                    let quantity = parseInt(inputElement.value);
                    
                    if (action === 'increase') {
                        quantity++;
                        // Animasi increase
                        inputElement.classList.add('quantity-changed-increase');
                        setTimeout(() => {
                            inputElement.classList.remove('quantity-changed-increase');
                        }, 500);
                    } else if (action === 'decrease' && quantity > 1) {
                        quantity--;
                        // Animasi decrease
                        inputElement.classList.add('quantity-changed-decrease');
                        setTimeout(() => {
                            inputElement.classList.remove('quantity-changed-decrease');
                        }, 500);
                    }
                    
                    inputElement.value = quantity;
                    
                    // Animasi loading pada item cart
                    cartItem.classList.add('updating');
                    
                    // Update cart via AJAX
                    $.ajax({
                        url: "{{ route('cart.update') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            product_id: productId,
                            quantity: quantity
                        },
                        success: function() {
                            // Hapus animasi loading
                            setTimeout(() => {
                                cartItem.classList.remove('updating');
                                // Tambahkan highlight effect
                                cartItem.classList.add('updated');
                                setTimeout(() => {
                                    cartItem.classList.remove('updated');
                                }, 1000);
                                // Reload page untuk update subtotal dan total
                                window.location.reload();
                            }, 500);
                        },
                        error: function(xhr, status, error) {
                            cartItem.classList.remove('updating');
                            console.error(error);
                            alert('Failed to update cart. Please try again.');
                        }
                    });
                });
            });
        }
        
        // Remove from cart with enhanced animation
        const removeFromCartBtns = document.querySelectorAll('.remove-from-cart');
        if (removeFromCartBtns.length > 0) {
            removeFromCartBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const cartItem = this.closest('.cart-item');
                    
                    // Tambahkan animasi shake
                    btn.classList.add('shake-button');
                    
                    // Tampilkan konfirmasi dengan efek animasi
                    const confirmBox = document.createElement('div');
                    confirmBox.className = 'confirm-delete-box';
                    confirmBox.innerHTML = `
                        <div class="confirm-delete-inner">
                            <p>Remove this item from cart?</p>
                            <div class="confirm-buttons">
                                <button class="btn btn-sm btn-secondary cancel-btn">Cancel</button>
                                <button class="btn btn-sm btn-danger confirm-btn">Remove</button>
                            </div>
                        </div>
                    `;
                    
                    document.body.appendChild(confirmBox);
                    
                    // Animasi tampilkan confirm box
                    setTimeout(() => {
                        confirmBox.classList.add('show');
                    }, 50);
                    
                    // Handle tombol cancel
                    confirmBox.querySelector('.cancel-btn').addEventListener('click', function() {
                        confirmBox.classList.remove('show');
                        btn.classList.remove('shake-button');
                        setTimeout(() => {
                            document.body.removeChild(confirmBox);
                        }, 300);
                    });
                    
                    // Handle tombol confirm
                    confirmBox.querySelector('.confirm-btn').addEventListener('click', function() {
                        // Sembunyikan confirm box
                        confirmBox.classList.remove('show');
                        setTimeout(() => {
                            document.body.removeChild(confirmBox);
                        }, 300);
                        
                        // Animasi remove item
                        cartItem.style.height = cartItem.offsetHeight + 'px';
                        cartItem.classList.add('removing');
                        
                        // Remove cart item via AJAX
                        $.ajax({
                            url: "{{ route('cart.remove') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                product_id: productId
                            },
                            success: function() {
                                // Animasi fade out dan collapse
                                setTimeout(() => {
                                    cartItem.style.height = '0';
                                    cartItem.style.opacity = '0';
                                    cartItem.style.margin = '0';
                                    cartItem.style.padding = '0';
                                    
                                    // Cek jika ini item terakhir
                                    const remainingItems = document.querySelectorAll('.cart-item:not(.removing)').length;
                                    
                                    setTimeout(() => {
                                        cartItem.remove();
                                        
                                        // Tampilkan animasi perubahan total
                                        const totalElement = document.querySelector('.cart-totals .fw-bold:last-child');
                                        if (totalElement) {
                                            totalElement.classList.add('total-updated');
                                        }
                                        
                                        // Jika cart kosong, reload halaman
                                        if (remainingItems === 0) {
                                            setTimeout(() => {
                                                window.location.reload();
                                            }, 800);
                                        } else {
                                            // Reload hanya untuk update total
                                            setTimeout(() => {
                                                window.location.reload();
                                            }, 800);
                                        }
                                    }, 500);
                                }, 200);
                            },
                            error: function(xhr, status, error) {
                                cartItem.classList.remove('removing');
                                console.error(error);
                                alert('Failed to remove item from cart. Please try again.');
                            }
                        });
                    });
                });
            });
        }
    });
</script>
@endsection