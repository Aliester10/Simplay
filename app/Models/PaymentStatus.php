<?php
// app/Models/PaymentStatus.php - ENHANCED WITH TIMEZONE AND PATH HANDLING

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
        'notes',
        'admin_notes',
        'payment_notes', // 🔥 ADDED: For user payment notes
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
        'rejected_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /*
    |--------------------------------------------------------------------------
    | 🕐 TIMEZONE-AWARE ACCESSORS - REAL-TIME DISPLAY
    |--------------------------------------------------------------------------
    |
    | These accessors automatically convert all timestamps to the application's
    | configured timezone for consistent real-time display to users.
    |
    */

    /**
     * 🔥 REAL-TIME: Get created_at in local timezone
     */
    public function getFormattedCreatedAtAttribute()
    {
        if (!$this->created_at) return null;
        
        $localTime = Carbon::parse($this->created_at)->setTimezone(config('app.timezone'));
        
        Log::debug('Timezone conversion for created_at', [
            'payment_id' => $this->id,
            'original' => $this->created_at->format('Y-m-d H:i:s T'),
            'converted' => $localTime->format('Y-m-d H:i:s T'),
            'timezone' => config('app.timezone'),
            'timestamp' => '2025-06-13 20:07:43'
        ]);

        return $localTime->format(config('app.datetime_format', 'd/m/Y H:i:s'));
    }

    /**
     * 🔥 REAL-TIME: Get updated_at in local timezone
     */
    public function getFormattedUpdatedAtAttribute()
    {
        if (!$this->updated_at) return null;
        
        $localTime = Carbon::parse($this->updated_at)->setTimezone(config('app.timezone'));
        return $localTime->format(config('app.datetime_format', 'd/m/Y H:i:s'));
    }

    /**
     * 🔥 REAL-TIME: Get payment_date in local timezone
     */
    public function getFormattedPaymentDateAttribute()
    {
        if (!$this->payment_date) return null;
        
        $localTime = Carbon::parse($this->payment_date)->setTimezone(config('app.timezone'));
        return $localTime->format(config('app.datetime_format', 'd/m/Y H:i:s'));
    }

    /**
     * 🔥 REAL-TIME: Get approved_at in local timezone
     */
    public function getFormattedApprovedAtAttribute()
    {
        if (!$this->approved_at) return null;
        
        $localTime = Carbon::parse($this->approved_at)->setTimezone(config('app.timezone'));
        return $localTime->format(config('app.datetime_format', 'd/m/Y H:i:s'));
    }

    /**
     * 🔥 REAL-TIME: Get rejected_at in local timezone
     */
    public function getFormattedRejectedAtAttribute()
    {
        if (!$this->rejected_at) return null;
        
        $localTime = Carbon::parse($this->rejected_at)->setTimezone(config('app.timezone'));
        return $localTime->format(config('app.datetime_format', 'd/m/Y H:i:s'));
    }

    /**
     * 🔥 REAL-TIME: Get human-readable time differences
     */
    public function getTimeAgoAttribute()
    {
        if (!$this->updated_at) return null;
        
        $localTime = Carbon::parse($this->updated_at)->setTimezone(config('app.timezone'));
        return $localTime->diffForHumans();
    }

    public function getPaymentTimeAgoAttribute()
    {
        if (!$this->payment_date) return null;
        
        $localTime = Carbon::parse($this->payment_date)->setTimezone(config('app.timezone'));
        return $localTime->diffForHumans();
    }

    public function getCreatedTimeAgoAttribute()
    {
        if (!$this->created_at) return null;
        
        $localTime = Carbon::parse($this->created_at)->setTimezone(config('app.timezone'));
        return $localTime->diffForHumans();
    }

    /**
     * 🔥 REAL-TIME: Get formatted timestamps with timezone display
     */
    public function getFormattedCreatedAtWithTimezoneAttribute()
    {
        if (!$this->created_at) return null;
        
        $localTime = Carbon::parse($this->created_at)->setTimezone(config('app.timezone'));
        return $localTime->format(config('app.payment.timestamp_format', 'd/m/Y H:i:s T'));
    }

    public function getFormattedPaymentDateWithTimezoneAttribute()
    {
        if (!$this->payment_date) return null;
        
        $localTime = Carbon::parse($this->payment_date)->setTimezone(config('app.timezone'));
        return $localTime->format(config('app.payment.timestamp_format', 'd/m/Y H:i:s T'));
    }

    /*
    |--------------------------------------------------------------------------
    | 🖼️ PAYMENT PROOF HANDLING - ENHANCED PATH COMPATIBILITY
    |--------------------------------------------------------------------------
    |
    | These methods handle payment proof files with support for multiple
    | path structures and storage locations for maximum compatibility.
    |
    */

    /**
     * 🔥 ENHANCED: Payment proof URL with path compatibility
     */
    public function getPaymentProofUrlAttribute()
    {
        if (!$this->payment_proof) {
            return null;
        }

        Log::info('Getting payment proof URL with timezone context', [
            'payment_id' => $this->id,
            'file' => $this->payment_proof,
            'timezone' => config('app.timezone'),
            'current_time' => Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s T'),
            'timestamp' => '2025-06-13 20:07:43'
        ]);

        // PRIORITY 1: Handle existing files with "payment/proofs/" path
        if (strpos($this->payment_proof, 'payment/proofs/') !== false) {
            // File already includes the full path
            $possiblePaths = [
                $this->payment_proof, // payment/proofs/payment_proof_4_1749789074.png
                str_replace('payment/proofs/', 'payment_proofs/', $this->payment_proof), // Convert to new format
                str_replace('payment/proofs/', 'payment-proofs/', $this->payment_proof), // Convert to newest format
                str_replace('payment/proofs/', '', $this->payment_proof) // Just filename
            ];
        } else {
            // Standard paths for new uploads
            $possiblePaths = [
                'payment-proofs/' . $this->payment_proof, // 🔥 NEWEST FORMAT
                'payment_proofs/' . $this->payment_proof,
                'payment/proofs/' . $this->payment_proof, // Support existing format
                $this->payment_proof
            ];
        }

        foreach ($possiblePaths as $path) {
            // Check if file exists in public storage disk
            if (Storage::disk('public')->exists($path)) {
                $url = Storage::disk('public')->url($path);
                Log::info('Payment proof found via storage disk', [
                    'path' => $path,
                    'url' => $url,
                    'payment_id' => $this->id,
                    'access_time' => Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s T')
                ]);
                return $url;
            }
            
            // Check if file exists in public folder directly
            $publicPath = public_path('storage/' . $path);
            if (file_exists($publicPath)) {
                $url = asset('storage/' . $path);
                Log::info('Payment proof found in public folder', [
                    'path' => $publicPath,
                    'url' => $url,
                    'payment_id' => $this->id,
                    'access_time' => Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s T')
                ]);
                return $url;
            }
        }

        // Log if no file found with timezone context
        Log::warning('Payment proof file not found with timezone context', [
            'payment_id' => $this->id,
            'file' => $this->payment_proof,
            'checked_paths' => $possiblePaths,
            'timezone' => config('app.timezone'),
            'search_time' => Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s T'),
            'timestamp' => '2025-06-13 20:07:43'
        ]);

        // Fallback: Construct URL based on existing path structure
        if (strpos($this->payment_proof, 'payment/proofs/') !== false) {
            return asset('storage/' . $this->payment_proof);
        }
        
        return asset('storage/payment-proofs/' . $this->payment_proof); // 🔥 DEFAULT TO NEWEST FORMAT
    }

    /**
     * 🔥 ENHANCED: File exists check with path compatibility
     */
    public function getPaymentProofExistsAttribute()
    {
        if (!$this->payment_proof) {
            return false;
        }

        // PRIORITY 1: Handle existing files with "payment/proofs/" path
        if (strpos($this->payment_proof, 'payment/proofs/') !== false) {
            $possiblePaths = [
                // Storage disk paths
                $this->payment_proof,
                str_replace('payment/proofs/', 'payment_proofs/', $this->payment_proof),
                str_replace('payment/proofs/', 'payment-proofs/', $this->payment_proof), // 🔥 NEWEST FORMAT
                
                // Direct file system paths
                storage_path('app/public/' . $this->payment_proof),
                public_path('storage/' . $this->payment_proof),
                storage_path('app/public/' . str_replace('payment/proofs/', 'payment_proofs/', $this->payment_proof)),
                public_path('storage/' . str_replace('payment/proofs/', 'payment_proofs/', $this->payment_proof)),
                storage_path('app/public/' . str_replace('payment/proofs/', 'payment-proofs/', $this->payment_proof)), // 🔥 NEWEST
                public_path('storage/' . str_replace('payment/proofs/', 'payment-proofs/', $this->payment_proof)) // 🔥 NEWEST
            ];
        } else {
            $possiblePaths = [
                // Storage disk paths
                'payment-proofs/' . $this->payment_proof, // 🔥 NEWEST FORMAT FIRST
                'payment_proofs/' . $this->payment_proof,
                'payment/proofs/' . $this->payment_proof,
                
                // Direct file system paths
                storage_path('app/public/payment-proofs/' . $this->payment_proof), // 🔥 NEWEST FORMAT
                storage_path('app/public/payment_proofs/' . $this->payment_proof),
                storage_path('app/public/payment/proofs/' . $this->payment_proof),
                public_path('storage/payment-proofs/' . $this->payment_proof), // 🔥 NEWEST FORMAT
                public_path('storage/payment_proofs/' . $this->payment_proof),
                public_path('storage/payment/proofs/' . $this->payment_proof)
            ];
        }

        foreach ($possiblePaths as $path) {
            // Check storage disk first
            if (strpos($path, storage_path()) === false && strpos($path, public_path()) === false) {
                if (Storage::disk('public')->exists($path)) {
                    Log::info('Payment proof exists via storage disk with timezone context', [
                        'path' => $path,
                        'payment_id' => $this->id,
                        'check_time' => Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s T')
                    ]);
                    return true;
                }
            }
            
            // Check direct file system
            if (file_exists($path)) {
                Log::info('Payment proof exists in file system with timezone context', [
                    'path' => $path,
                    'payment_id' => $this->id,
                    'check_time' => Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s T')
                ]);
                return true;
            }
        }

        Log::warning('Payment proof does not exist anywhere with timezone context', [
            'payment_id' => $this->id,
            'file' => $this->payment_proof,
            'checked_paths' => $possiblePaths,
            'timezone' => config('app.timezone'),
            'check_time' => Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s T')
        ]);

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | 🔗 MODEL RELATIONSHIPS
    |--------------------------------------------------------------------------
    |
    | Define the relationships between PaymentStatus and other models.
    |
    */

    /**
     * Get the order associated with this payment
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the admin user who approved this payment
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the customer who made this payment
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_email', 'email');
    }

    /*
    |--------------------------------------------------------------------------
    | 🔧 UTILITY METHODS - ENHANCED FOR REAL-TIME OPERATIONS
    |--------------------------------------------------------------------------
    |
    | Additional utility methods for enhanced functionality.
    |
    */

    /**
     * 🔥 REAL-TIME: Check if payment is recent (within last hour)
     */
    public function getIsRecentAttribute()
    {
        if (!$this->created_at) return false;
        
        $localTime = Carbon::parse($this->created_at)->setTimezone(config('app.timezone'));
        $currentTime = Carbon::now(config('app.timezone'));
        
        return $localTime->diffInHours($currentTime) < 1;
    }

    /**
     * 🔥 REAL-TIME: Get payment status with emoji for UI display
     */
    public function getStatusWithEmojiAttribute()
    {
        $statusEmojis = [
            'pending' => '⏳ Pending Review',
            'approved' => '✅ Approved',
            'rejected' => '❌ Rejected'
        ];

        return $statusEmojis[$this->status] ?? '❓ ' . ucfirst($this->status);
    }

    /**
     * 🔥 REAL-TIME: Get payment summary for logging/display
     */
    public function getPaymentSummaryAttribute()
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'customer' => $this->customer_name,
            'amount' => 'Rp ' . number_format($this->amount, 0, ',', '.'),
            'status' => $this->status,
            'has_proof' => $this->payment_proof ? true : false,
            'created_local' => $this->formatted_created_at_with_timezone,
            'updated_local' => $this->formatted_updated_at ? Carbon::parse($this->updated_at)->setTimezone(config('app.timezone'))->format('d/m/Y H:i:s T') : null,
            'timezone' => config('app.timezone')
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | 📝 MODEL EVENTS - REAL-TIME LOGGING
    |--------------------------------------------------------------------------
    |
    | Automatically log important events with timezone context.
    |
    */

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            Log::info('Payment status record being created with timezone context', [
                'invoice_id' => $payment->invoice_id,
                'customer_email' => $payment->customer_email,
                'amount' => $payment->amount,
                'status' => $payment->status,
                'timezone' => config('app.timezone'),
                'creation_time' => Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s T'),
                'timestamp' => '2025-06-13 20:07:43'
            ]);
        });

        static::updating(function ($payment) {
            $original = $payment->getOriginal();
            
            if ($payment->isDirty('status')) {
                Log::info('Payment status being updated with timezone context', [
                    'payment_id' => $payment->id,
                    'invoice_id' => $payment->invoice_id,
                    'old_status' => $original['status'],
                    'new_status' => $payment->status,
                    'timezone' => config('app.timezone'),
                    'update_time' => Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s T'),
                    'timestamp' => '2025-06-13 20:07:43'
                ]);
            }
        });
    }
}