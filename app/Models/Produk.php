<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quotation;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = ['nama', 'merk', 'link', 'deskripsi', 'spesifikasi', 'harga', 'user_manual', 'kategori_id'];

    protected $casts = [
        'harga' => 'decimal:2'
    ];

    public function images()
    {
        return $this->hasMany(ProdukImage::class, 'produk_id');
    }

    public function videos()
    {
        return $this->hasMany(ProdukVideo::class, 'produk_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function produks()
    {
        return $this->hasMany(Produk::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_produk', 'produk_id', 'user_id');
    }

    public function documentCertificationsProduk()
    {
        return $this->hasMany(DocumentCertificationsProduk::class);
    }

    public function brosur()
    {
        return $this->hasMany(Brosur::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class, 'produk_id');
    }

    public function quotationProducts()
    {
        return $this->hasMany(QuotationProduct::class, 'produk_id');
    }

    // ========== CART SYSTEM ADDITIONS ==========
    
    /**
     * Relationship to Cart - NEW
     */
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Check if product is in user's cart - NEW
     */
    public function isInCart($userId)
    {
        return $this->cartItems()->where('user_id', $userId)->exists();
    }

    /**
     * Get cart quantity for specific user - NEW
     */
    public function getCartQuantity($userId)
    {
        $cartItem = $this->cartItems()->where('user_id', $userId)->first();
        return $cartItem ? $cartItem->quantity : 0;
    }

    /**
     * Get formatted price - NEW
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Get main image - NEW
     */
    public function getMainImageAttribute()
    {
        $image = $this->images->first();
        return $image ? asset($image->gambar) : asset('assets/img/default.jpg');
    }

    /**
     * Scope for available products - NEW
     */
    public function scopeAvailable($query)
    {
        return $query->where('harga', '>', 0);
    }

    /**
     * Get product summary for cart - NEW
     */
    public function getCartSummaryAttribute()
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'merk' => $this->merk,
            'harga' => $this->harga,
            'formatted_price' => $this->formatted_price,
            'main_image' => $this->main_image
        ];
    }
}