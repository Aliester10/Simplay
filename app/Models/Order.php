<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'payment_method',
        'rejection_reason'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentStatus()
    {
        return $this->hasOne(PaymentStatus::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending_payment' => 'badge-warning',
            'processing' => 'badge-info',
            'completed' => 'badge-success',
            'cancelled' => 'badge-secondary',
            'rejected' => 'badge-danger',
            default => 'badge-light'
        };
    }
}