<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'customer_name',
        'customer_email',
        'amount',
        'payment_method',
        'status',
        'payment_proof',
        'admin_notes',
        'reject_reason',
        'payment_date',
        'approved_at',
        'rejected_at',
        'approved_by',
        'order_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime'
    ];

    /**
     * Relationship to Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relationship to User (customer) via email
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_email', 'email');
    }

    /**
     * Relationship to User who approved (admin)
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'uploaded' => 'info',
            'verified' => 'primary',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Get payment proof URL
     */
    public function getPaymentProofUrlAttribute()
    {
        if ($this->payment_proof) {
            return asset('storage/' . $this->payment_proof);
        }
        return null;
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Pending Payment',
            'uploaded' => 'Payment Proof Uploaded',
            'verified' => 'Payment Verified',
            'approved' => 'Payment Approved',
            'rejected' => 'Payment Rejected',
            default => 'Unknown Status'
        };
    }

    /**
     * Get payment method label
     */
    public function getPaymentMethodLabelAttribute()
    {
        return match($this->payment_method) {
            'bank_transfer' => 'Bank Transfer',
            'qris' => 'QRIS',
            'cash' => 'Cash',
            'credit_card' => 'Credit Card',
            default => ucfirst(str_replace('_', ' ', $this->payment_method))
        };
    }

    /**
     * Check if payment proof exists
     */
    public function hasPaymentProofAttribute()
    {
        return !empty($this->payment_proof) && file_exists(storage_path('app/public/' . $this->payment_proof));
    }

    /**
     * Get days since payment created
     */
    public function getDaysSinceCreatedAttribute()
    {
        return $this->created_at->diffInDays(now());
    }

    /**
     * Check if payment is overdue
     */
    public function getIsOverdueAttribute()
    {
        if (!$this->payment_date) {
            return false;
        }
        
        return now()->gt($this->payment_date->addDays(3)) && in_array($this->status, ['pending', 'uploaded']);
    }

    /**
     * Scope for pending payments
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for uploaded payments
     */
    public function scopeUploaded($query)
    {
        return $query->where('status', 'uploaded');
    }

    /**
     * Scope for approved payments
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for rejected payments
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope for payments by user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->whereHas('user', function($q) use ($userId) {
            $q->where('id', $userId);
        });
    }

    /**
     * Scope for payments by email
     */
    public function scopeByEmail($query, $email)
    {
        return $query->where('customer_email', $email);
    }

    /**
     * Scope for recent payments
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Approve payment
     */
    public function approve($adminId, $notes = null)
    {
        $this->update([
            'status' => 'approved',
            'approved_by' => $adminId,
            'approved_at' => now(),
            'admin_notes' => $notes
        ]);

        // Update related order status
        if ($this->order) {
            $this->order->update(['status' => 'completed']);
        }

        return $this;
    }

    /**
     * Reject payment
     */
    public function reject($adminId, $reason, $notes = null)
    {
        $this->update([
            'status' => 'rejected',
            'approved_by' => $adminId,
            'rejected_at' => now(),
            'reject_reason' => $reason,
            'admin_notes' => $notes
        ]);

        // Update related order status
        if ($this->order) {
            $this->order->update([
                'status' => 'rejected',
                'rejection_reason' => $reason
            ]);
        }

        return $this;
    }

    /**
     * Verify payment (intermediate step)
     */
    public function verify($adminId, $notes = null)
    {
        $this->update([
            'status' => 'verified',
            'approved_by' => $adminId,
            'admin_notes' => $notes
        ]);

        return $this;
    }

    /**
     * Upload payment proof
     */
    public function uploadProof($filePath)
    {
        $this->update([
            'payment_proof' => $filePath,
            'status' => 'uploaded'
        ]);

        return $this;
    }

    /**
     * Get order items (if order exists)
     */
    public function getOrderItemsAttribute()
    {
        if (!$this->order) {
            return collect();
        }

        // Assuming order has cart_items or related products
        // Adjust based on your Order model structure
        return $this->order->cart_items ?? collect();
    }

    /**
     * Generate next invoice number
     */
    public static function generateInvoiceNumber()
    {
        $lastPayment = self::latest()->first();
        $lastNumber = $lastPayment ? (int) substr($lastPayment->invoice_id, -5) : 0;
        $newNumber = $lastNumber + 1;
        
        return 'INV-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Create payment from order
     */
    public static function createFromOrder($order, $paymentMethod = 'bank_transfer')
    {
        return self::create([
            'invoice_id' => self::generateInvoiceNumber(),
            'customer_name' => $order->user->name,
            'customer_email' => $order->user->email,
            'amount' => $order->total_amount,
            'payment_method' => $paymentMethod,
            'payment_date' => now(),
            'order_id' => $order->id,
            'status' => 'pending'
        ]);
    }

    /**
     * Get summary stats for admin dashboard
     */
    public static function getSummaryStats()
    {
        return [
            'total_payments' => self::count(),
            'pending_payments' => self::pending()->count(),
            'uploaded_payments' => self::uploaded()->count(),
            'approved_payments' => self::approved()->count(),
            'rejected_payments' => self::rejected()->count(),
            'total_amount' => self::approved()->sum('amount'),
            'pending_amount' => self::whereIn('status', ['pending', 'uploaded', 'verified'])->sum('amount'),
            'recent_payments' => self::recent(7)->count(),
        ];
    }

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate invoice number on creation
        static::creating(function ($payment) {
            if (empty($payment->invoice_id)) {
                $payment->invoice_id = self::generateInvoiceNumber();
            }
        });
    }
}