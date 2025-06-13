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
                                            <button class="btn btn-success checkout-btn" onclick="openPaymentModal()">
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

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modern-modal">
            <div class="modal-header modern-header">
                <div class="header-content">
                    <i class="fas fa-credit-card header-icon"></i>
                    <h5 class="modal-title" id="paymentModalLabel">Complete Your Payment</h5>
                </div>
                <button type="button" class="btn-close-modern" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body modern-body">
                <!-- Step 1: Payment Methods -->
                <div class="step-content" id="step-payment-methods">
                    <div class="step-header">
                        <h6 class="step-title">
                            <i class="fas fa-money-bill-wave"></i> 
                            Choose Payment Method
                        </h6>
                    </div>
                    
                    <div class="payment-methods">
                        <!-- Bank Transfer -->
                        <div class="payment-method-card modern-card" data-method="bank_transfer">
                            <div class="method-header">
                                <div class="method-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <h6 class="method-title">Bank Transfer</h6>
                            </div>
                            <div class="method-details" id="bank-details" style="display: none;">
                                <div class="bank-info">
                                    <div class="info-item">
                                        <span class="info-label">Bank:</span>
                                        <span class="info-value" id="bank-name">Loading...</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Account Number:</span>
                                        <span class="info-value" id="account-number">Loading...</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Account Name:</span>
                                        <span class="info-value" id="account-name">Loading...</span>
                                    </div>
                                </div>
                                <div class="payment-instructions">
                                    <h6>Payment Instructions:</h6>
                                    <div class="alert alert-info modern-alert" id="payment-instructions">Loading...</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- QR Code Payment -->
                        <div class="payment-method-card modern-card active" data-method="qris">
                            <div class="method-header">
                                <div class="method-icon">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                                <h6 class="method-title">QR Code Payment</h6>
                            </div>
                            <div class="method-details" id="qr-details">
                                <div class="qr-display-container">
                                    <div id="qr-code-display" class="qr-display">
                                        <div class="loading-state">
                                            <div class="spinner-modern"></div>
                                            <p>Loading QR Code...</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="qr-instructions">
                                    <h6>How to Pay:</h6>
                                    <ol class="instruction-list">
                                        <li>Open your mobile banking or e-wallet app</li>
                                        <li>Scan the QR code above</li>
                                        <li>Confirm the payment amount: <strong>Rp {{ number_format($total ?? 0, 0, ',', '.') }}</strong></li>
                                        <li>Complete the payment</li>
                                        <li>Upload your payment proof below</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button class="btn btn-primary modern-btn" onclick="showUploadStep()">
                            I've Made the Payment <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Step 2: Upload Proof -->
                <div class="step-content" id="step-upload-proof" style="display: none;">
                    <div class="step-header">
                        <h6 class="step-title">
                            <i class="fas fa-cloud-upload-alt"></i> 
                            Upload Payment Proof
                        </h6>
                    </div>
                    
                    <form id="payment-proof-form" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-area">
                            <div class="upload-zone modern-upload" id="upload-zone">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <h6>Drag & Drop your payment proof here</h6>
                                <p class="text-muted">or click to browse</p>
                                <input type="file" id="payment-proof-input" name="payment_proof" accept="image/*" style="display: none;">
                            </div>
                            <div class="upload-preview" id="upload-preview" style="display: none;">
                                <img id="preview-image" src="" alt="Payment Proof Preview">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="removePreview()">
                                    <i class="fas fa-times"></i> Remove
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label class="form-label">Additional Notes (Optional)</label>
                            <textarea class="form-control modern-textarea" name="notes" rows="3" placeholder="Add any additional information about your payment..."></textarea>
                        </div>
                        
                        <div class="button-group mt-4">
                            <button type="button" class="btn btn-secondary modern-btn-secondary" onclick="showPaymentMethods()">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                            <button type="submit" class="btn btn-success modern-btn-success" id="submit-payment-btn" disabled>
                                <i class="fas fa-check"></i> Submit Payment Proof
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Step 3: Success -->
                <div class="step-content" id="step-success" style="display: none;">
                    <div class="success-content">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4 class="success-title">Payment Submitted Successfully!</h4>
                        <p class="success-description">Your payment proof has been uploaded and is now being reviewed by our team.</p>
                        <p class="success-note">You will receive a confirmation once your payment is verified.</p>
                        
                        <div class="success-actions">
                            <a href="{{ route('member.payment.status') }}" class="btn btn-primary modern-btn">
                                <i class="fas fa-list"></i> View Payment Status
                            </a>
                            <a href="{{ route('portal') }}" class="btn btn-secondary modern-btn-secondary">
                                <i class="fas fa-home"></i> Back to Portal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QR Image Modal -->
<div class="modal fade" id="qrImageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">QR Code Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center qr-modal-body">
                <img id="modalQRImage" src="" alt="QR Code" class="qr-modal-image">
            </div>
        </div>
    </div>
</div>

<!-- CLEAN QR CSS STYLES - NO TEXT INFO -->
<style>
    /* Cart Page Styles */
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
        color: #007bff;
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
        background: #f8f9fa;
        border: none;
        width: 35px;
        height: 35px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #495057;
        transition: all 0.2s;
    }
    
    .cart-quantity-control .quantity-btn:hover {
        background: #e9ecef;
        color: #007bff;
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
    
    /* MODERN MODAL STYLES */
    .modern-modal {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }
    
    .modern-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 25px 30px;
        position: relative;
    }
    
    .header-content {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .header-icon {
        font-size: 1.5rem;
        opacity: 0.9;
    }
    
    .modal-title {
        margin: 0;
        font-weight: 600;
        font-size: 1.25rem;
    }
    
    .btn-close-modern {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-close-modern:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }
    
    .modern-body {
        padding: 30px;
        background: #f8f9fa;
    }
    
    /* Step Header */
    .step-header {
        margin-bottom: 25px;
    }
    
    .step-title {
        color: #495057;
        font-weight: 600;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin: 0;
    }
    
    /* Payment Methods */
    .payment-methods {
        display: grid;
        gap: 20px;
        margin: 25px 0;
    }
    
    .modern-card {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 16px;
        padding: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .modern-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .modern-card:hover {
        border-color: #007bff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 123, 255, 0.15);
    }
    
    .modern-card:hover::before {
        transform: scaleX(1);
    }
    
    .modern-card.active {
        border-color: #007bff;
        background: linear-gradient(135deg, #f8f9ff 0%, #e3f2fd 100%);
        box-shadow: 0 8px 25px rgba(0, 123, 255, 0.2);
    }
    
    .modern-card.active::before {
        transform: scaleX(1);
    }
    
    .method-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .method-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }
    
    .method-title {
        margin: 0;
        font-weight: 600;
        color: #495057;
    }
    
    .method-details {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }
    
    /* CLEAN QR DISPLAY - NO TEXT INFO */
    .qr-display-container {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        padding: 15px;
        border-radius: 20px;
        border: 2px solid #e9ecef;
        margin-bottom: 25px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        width: 100%;
        height: 400px;
        max-width: 686px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .qr-display {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    
    /* QR Image CLEAN CONTAINER */
    .qr-image-wrapper {
        width: 100%;
        height: 100%;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .qr-image-fit {
        width: 100% !important;
        height: 100% !important;
        max-width: 656px !important;
        max-height: 370px !important;
        object-fit: contain !important;
        border-radius: 8px !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        background: white !important;
    }
    
    .qr-image-fit:hover {
        transform: scale(1.02) !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15) !important;
    }
    
    .loading-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
    
    .spinner-modern {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #007bff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* QR Instructions */
    .qr-instructions {
        background: white;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #e9ecef;
    }
    
    .qr-instructions h6 {
        color: #495057;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .instruction-list {
        margin: 0;
        padding-left: 20px;
    }
    
    .instruction-list li {
        margin-bottom: 8px;
        color: #6c757d;
        line-height: 1.5;
    }
    
    /* Bank Info */
    .bank-info {
        background: white;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        margin-bottom: 20px;
    }
    
    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f1f3f4;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #495057;
    }
    
    .info-value {
        color: #6c757d;
        font-weight: 500;
    }
    
    /* Upload Area */
    .upload-area {
        margin: 25px 0;
    }
    
    .modern-upload {
        border: 2px dashed #007bff;
        border-radius: 16px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }
    
    .modern-upload:hover {
        border-color: #0056b3;
        background: linear-gradient(135deg, #f8f9ff 0%, #e3f2fd 100%);
        transform: translateY(-2px);
    }
    
    .upload-icon {
        font-size: 3rem;
        color: #007bff;
        margin-bottom: 15px;
    }
    
    .modern-upload h6 {
        color: #495057;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .upload-preview {
        text-align: center;
        padding: 20px;
        background: white;
        border-radius: 12px;
        border: 1px solid #e9ecef;
    }
    
    .upload-preview img {
        max-width: 300px;
        max-height: 200px;
        border-radius: 12px;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Form Elements */
    .modern-textarea {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 15px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .modern-textarea:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    /* Buttons */
    .modern-btn {
        padding: 12px 25px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .modern-btn-secondary {
        background: #6c757d;
        color: white;
    }
    
    .modern-btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-1px);
    }
    
    .modern-btn-success {
        background: #28a745;
        color: white;
    }
    
    .modern-btn-success:hover {
        background: #218838;
        transform: translateY(-1px);
    }
    
    .button-group {
        display: flex;
        gap: 15px;
        justify-content: center;
    }
    
    /* Success Content */
    .success-content {
        text-align: center;
        padding: 30px 20px;
        background: white;
        border-radius: 16px;
    }
    
    .success-icon {
        font-size: 4rem;
        color: #28a745;
        margin-bottom: 20px;
    }
    
    .success-title {
        color: #495057;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .success-description {
        color: #6c757d;
        margin-bottom: 10px;
        line-height: 1.6;
    }
    
    .success-note {
        color: #6c757d;
        margin-bottom: 30px;
        font-size: 14px;
    }
    
    .success-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    /* Modern Alert */
    .modern-alert {
        border: none;
        border-radius: 12px;
        padding: 15px 20px;
        background: linear-gradient(135deg, #e3f2fd 0%, #f8f9ff 100%);
        border-left: 4px solid #007bff;
    }
    
    /* ENHANCED QR MODAL */
    #qrImageModal .modal-dialog {
        max-width: 800px;
    }
    
    .qr-modal-body {
        padding: 40px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .qr-modal-image {
        width: 100%;
        max-width: 700px;
        height: auto;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        transition: all 0.3s ease;
    }
    
    .qr-modal-image:hover {
        transform: scale(1.02);
    }
    
    /* Responsive Clean QR */
    @media (max-width: 1200px) {
        .qr-display-container {
            max-width: 100%;
        }
    }
    
    @media (max-width: 768px) {
        .cart-page-wrapper {
            padding: 20px;
        }
        
        .modern-header {
            padding: 20px;
        }
        
        .modern-body {
            padding: 20px;
        }
        
        .qr-display-container {
            height: 350px;
            padding: 12px;
        }
        
        .qr-image-fit {
            max-height: 320px !important;
        }
        
        .modern-card {
            padding: 20px;
        }
        
        .method-header {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }
        
        .button-group {
            flex-direction: column;
        }
        
        .success-actions {
            flex-direction: column;
        }
        
        .qr-modal-image {
            max-width: 450px;
        }
    }
    
    @media (max-width: 480px) {
        .qr-display-container {
            height: 300px;
            padding: 10px;
        }
        
        .qr-image-fit {
            max-height: 270px !important;
        }
        
        .qr-modal-image {
            max-width: 350px;
        }
    }
</style>

<!-- CLEAN QR JavaScript - NO TEXT INFO -->
<script>
    let currentPaymentId = null;
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('🎯 CLEAN QR Cart Loaded - 2025-06-13 07:57:45 UTC');
        console.log('👤 Current User: Aliester10');
        initializeCart();
        initializePaymentModal();
    });
    
    function initializeCart() {
        document.querySelectorAll('.update-quantity').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const action = this.getAttribute('data-action');
                const inputElement = this.parentElement.querySelector('.quantity-input');
                let quantity = parseInt(inputElement.value);
                
                if (action === 'increase') {
                    quantity++;
                } else if (action === 'decrease' && quantity > 1) {
                    quantity--;
                }
                
                inputElement.value = quantity;
                
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function() {
                        setTimeout(() => window.location.reload(), 300);
                    }
                });
            });
        });
        
        document.querySelectorAll('.remove-from-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Remove this item from cart?')) {
                    const productId = this.getAttribute('data-id');
                    
                    $.ajax({
                        url: "{{ route('cart.remove') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            product_id: productId
                        },
                        success: function() {
                            setTimeout(() => window.location.reload(), 300);
                        }
                    });
                }
            });
        });
    }
    
    function initializePaymentModal() {
        document.querySelectorAll('.payment-method-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.payment-method-card').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                
                const method = this.getAttribute('data-method');
                if (method === 'bank_transfer') {
                    document.getElementById('bank-details').style.display = 'block';
                    document.getElementById('qr-details').style.display = 'none';
                } else {
                    document.getElementById('bank-details').style.display = 'none';
                    document.getElementById('qr-details').style.display = 'block';
                    setTimeout(loadCleanQR, 200);
                }
            });
        });
        
        const uploadZone = document.getElementById('upload-zone');
        const fileInput = document.getElementById('payment-proof-input');
        
        if (uploadZone && fileInput) {
            uploadZone.addEventListener('click', () => fileInput.click());
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        document.getElementById('preview-image').src = e.target.result;
                        uploadZone.style.display = 'none';
                        document.getElementById('upload-preview').style.display = 'block';
                        document.getElementById('submit-payment-btn').disabled = false;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
        
        document.getElementById('payment-proof-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!currentPaymentId) {
                alert('Error: No payment ID found. Please try again.');
                return;
            }
            
            const formData = new FormData();
            formData.append('payment_proof', fileInput.files[0]);
            formData.append('notes', document.querySelector('textarea[name="notes"]').value);
            formData.append('_token', '{{ csrf_token() }}');
            
            try {
                const response = await fetch(`{{ url('/payment') }}/${currentPaymentId}/upload-proof`, {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                if (result.success) {
                    showSuccessStep();
                }
            } catch (error) {
                alert('Error uploading payment proof. Please try again.');
            }
        });
    }
    
    async function openPaymentModal() {
        $('#paymentModal').modal('show');
        setTimeout(loadCleanQR, 500);
        await loadPaymentSettings();
    }
    
    // CLEAN QR LOAD FUNCTION - NO TEXT INFO
    function loadCleanQR() {
        const endpoints = [
            '/en/api/payment-settings',
            '/en/portal/payment/get-settings',
            '/en/debug/qr-test'
        ];
        
        endpoints.forEach((endpoint, index) => {
            fetch(endpoint)
                .then(response => response.json())
                .then(data => {
                    let qrUrl = null;
                    
                    if (data.success && data.data && data.data.qr_image && data.data.qr_image.full_url) {
                        qrUrl = data.data.qr_image.full_url;
                    } else if (data.data && data.qr_image && data.qr_image.full_url) {
                        qrUrl = data.qr_image.full_url;
                    } else if (data.qr_debug_info && data.qr_debug_info.base64_preview) {
                        qrUrl = data.qr_debug_info.base64_preview;
                    }
                    
                    if (qrUrl) {
                        const qrDisplay = document.getElementById('qr-code-display');
                        if (qrDisplay) {
                            qrDisplay.innerHTML = `
                                <div class="qr-image-wrapper">
                                    <img src="${qrUrl}" 
                                         alt="QR Code Payment" 
                                         class="qr-image-fit"
                                         onclick="showQRModal('${qrUrl}')"
                                         onload="console.log('✅ Clean QR loaded successfully!')"
                                         onerror="console.error('❌ Clean QR failed to load')">
                                </div>
                            `;
                        }
                        return;
                    }
                })
                .catch(error => console.error(`❌ Clean QR API ${index + 1} failed:`, error));
        });
    }
    
    async function loadPaymentSettings() {
        try {
            const response = await fetch('{{ route("member.payment.get-settings") }}');
            const paymentSettings = await response.json();
            
            if (paymentSettings.success && paymentSettings.data) {
                const data = paymentSettings.data;
                
                document.getElementById('bank-name').textContent = data.bank_name || 'Not set';
                document.getElementById('account-number').textContent = data.account_number || 'Not set';
                document.getElementById('account-name').textContent = data.account_name || 'Not set';
                document.getElementById('payment-instructions').textContent = data.payment_instructions || 'No instructions';
                
                if (data.qr_image && data.qr_image.full_url) {
                    const qrDisplay = document.getElementById('qr-code-display');
                    qrDisplay.innerHTML = `
                        <div class="qr-image-wrapper">
                            <img src="${data.qr_image.full_url}" 
                                 alt="QR Code Payment" 
                                 class="qr-image-fit"
                                 onclick="showQRModal('${data.qr_image.full_url}')"
                                 onload="console.log('✅ Clean QR loaded from settings!')"
                                 onerror="loadCleanQR()">
                        </div>
                    `;
                } else {
                    loadCleanQR();
                }
            }
        } catch (error) {
            loadCleanQR();
        }
    }
    
    function showQRModal(imageSrc) {
        document.getElementById('modalQRImage').src = imageSrc;
        new bootstrap.Modal(document.getElementById('qrImageModal')).show();
    }
    
    function showUploadStep() {
        document.getElementById('step-payment-methods').style.display = 'none';
        document.getElementById('step-upload-proof').style.display = 'block';
        createOrder();
    }
    
    function showPaymentMethods() {
        document.getElementById('step-upload-proof').style.display = 'none';
        document.getElementById('step-payment-methods').style.display = 'block';
    }
    
    function showSuccessStep() {
        document.getElementById('step-upload-proof').style.display = 'none';
        document.getElementById('step-success').style.display = 'block';
    }
    
    function removePreview() {
        document.getElementById('upload-zone').style.display = 'block';
        document.getElementById('upload-preview').style.display = 'none';
        document.getElementById('payment-proof-input').value = '';
        document.getElementById('submit-payment-btn').disabled = true;
    }
    
    async function createOrder() {
        try {
            const response = await fetch('{{ route("checkout.process") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ payment_method: 'qris' })
            });
            
            const result = await response.json();
            if (result.success) {
                currentPaymentId = result.payment_id;
            }
        } catch (error) {
            console.error('Order creation error:', error);
        }
    }
    
    $('#paymentModal').on('shown.bs.modal', function() {
        setTimeout(loadCleanQR, 300);
    });
    
    window.loadCleanQR = loadCleanQR;
</script>
@endsection