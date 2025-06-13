<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'nama_perusahaan',
        'bidang_perusahaan',
        'no_telp',
        'alamat',
        'bidang_id', // Pastikan bidang_id ada dalam fillable
        'location_id',
        'pic',
        'nomor_telp_pic',
        'akta',
        'nib',
        'verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["member", "admin", "distributor"][$value] ?? "member",
        );
    }

    // ========== ORIGINAL RELATIONS ==========
    public function bidangPerusahaan()
    {
        return $this->belongsTo(BidangPerusahaan::class, 'bidang_id');
    }

    public function userProduk()
    {
        return $this->hasMany(UserProduk::class, 'user_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function isVerifiedDistributor(): bool
    {
        return $this->type === 'distributor' && $this->verified;
    }

    // ========== PAYMENT SYSTEM ADDITIONS ==========
    
    /**
     * Relasi ke orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relasi ke payment statuses yang di-approve oleh user ini (untuk admin)
     */
    public function approvedPayments()
    {
        return $this->hasMany(PaymentStatus::class, 'approved_by');
    }

    /**
     * Relationship to Cart - NEW
     */
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get total cart amount for user - NEW
     */
    public function getCartTotalAttribute()
    {
        return $this->cartItems->sum(function($item) {
            return $item->quantity * $item->price;
        });
    }

    /**
     * Get cart items count - NEW
     */
    public function getCartCountAttribute()
    {
        return $this->cartItems->sum('quantity');
    }

    /**
     * Clear user cart - NEW
     */
    public function clearCart()
    {
        return $this->cartItems()->delete();
    }

    /**
     * Add product to cart - NEW
     */
    public function addToCart($produkId, $quantity = 1, $price = null)
    {
        $produk = Produk::find($produkId);
        if (!$produk) {
            return false;
        }

        $price = $price ?? $produk->harga;

        $cartItem = $this->cartItems()->where('produk_id', $produkId)->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
        } else {
            $cartItem = $this->cartItems()->create([
                'produk_id' => $produkId,
                'quantity' => $quantity,
                'price' => $price
            ]);
        }

        return $cartItem;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->type === 'admin';
    }

    /**
     * Check if user is member
     */
    public function isMember(): bool
    {
        return $this->type === 'member';
    }

    /**
     * Check if user is distributor
     */
    public function isDistributor(): bool
    {
        return $this->type === 'distributor';
    }

    /**
     * Get raw type value (0, 1, 2) untuk compatibility dengan payment system
     */
    public function getRawTypeAttribute()
    {
        // Mengambil nilai asli dari database sebelum di-cast
        return $this->attributes['type'];
    }

    /**
     * Check raw type for backward compatibility
     */
    public function isRawAdmin(): bool
    {
        return $this->getRawTypeAttribute() == 1;
    }

    public function isRawMember(): bool
    {
        return $this->getRawTypeAttribute() == 0;
    }

    public function isRawDistributor(): bool
    {
        return $this->getRawTypeAttribute() == 2;
    }

    /**
     * Get user's payment statuses (untuk customer yang punya payment)
     */
    public function paymentStatuses()
    {
        return $this->hasManyThrough(
            PaymentStatus::class,
            Order::class,
            'user_id', // foreign key on orders table
            'order_id', // foreign key on payment_statuses table
            'id', // local key on users table
            'id' // local key on orders table
        );
    }

    /**
     * Get display name untuk payment system
     */
    public function getDisplayNameAttribute()
    {
        return $this->name ?: $this->email;
    }

    /**
     * Get user type badge untuk UI
     */
    public function getTypeBadgeAttribute()
    {
        return match($this->type) {
            'admin' => 'badge-danger',
            'distributor' => 'badge-warning',
            'member' => 'badge-primary',
            default => 'badge-secondary'
        };
    }
}