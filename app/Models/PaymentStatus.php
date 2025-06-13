<?php
// app/Models/PaymentStatus.php - PATH MISMATCH FIX

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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

    // FIXED PAYMENT PROOF URL ACCESSOR - HANDLES EXISTING PATH STRUCTURE
    public function getPaymentProofUrlAttribute()
    {
        if (!$this->payment_proof) {
            return null;
        }

        Log::info('Getting payment proof URL - PATH FIX', [
            'payment_id' => $this->id,
            'file' => $this->payment_proof,
            'timestamp' => '2025-06-13 18:23:52'
        ]);

        // PRIORITY 1: Handle existing files with "payment/proofs/" path
        if (strpos($this->payment_proof, 'payment/proofs/') !== false) {
            // File already includes the full path
            $possiblePaths = [
                $this->payment_proof, // payment/proofs/payment_proof_4_1749789074.png
                str_replace('payment/proofs/', 'payment_proofs/', $this->payment_proof), // Convert to new format
                str_replace('payment/proofs/', '', $this->payment_proof) // Just filename
            ];
        } else {
            // Standard paths for new uploads
            $possiblePaths = [
                'payment_proofs/' . $this->payment_proof,
                'payment/proofs/' . $this->payment_proof, // Support existing format
                'payment-proofs/' . $this->payment_proof,
                $this->payment_proof
            ];
        }

        foreach ($possiblePaths as $path) {
            // Check if file exists in public storage disk
            if (Storage::disk('public')->exists($path)) {
                $url = Storage::disk('public')->url($path);
                Log::info('Payment proof found via storage disk - PATH FIX', [
                    'path' => $path,
                    'url' => $url,
                    'payment_id' => $this->id
                ]);
                return $url;
            }
            
            // Check if file exists in public folder directly
            $publicPath = public_path('storage/' . $path);
            if (file_exists($publicPath)) {
                $url = asset('storage/' . $path);
                Log::info('Payment proof found in public folder - PATH FIX', [
                    'path' => $publicPath,
                    'url' => $url,
                    'payment_id' => $this->id
                ]);
                return $url;
            }
        }

        // Log if no file found
        Log::warning('Payment proof file not found - PATH FIX', [
            'payment_id' => $this->id,
            'file' => $this->payment_proof,
            'checked_paths' => $possiblePaths,
            'timestamp' => '2025-06-13 18:23:52'
        ]);

        // Fallback: Construct URL based on existing path structure
        if (strpos($this->payment_proof, 'payment/proofs/') !== false) {
            return asset('storage/' . $this->payment_proof);
        }
        
        return asset('storage/payment_proofs/' . $this->payment_proof);
    }

    // FIXED FILE EXISTS CHECK - HANDLES EXISTING PATH STRUCTURE
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
                
                // Direct file system paths
                storage_path('app/public/' . $this->payment_proof),
                public_path('storage/' . $this->payment_proof),
                storage_path('app/public/' . str_replace('payment/proofs/', 'payment_proofs/', $this->payment_proof)),
                public_path('storage/' . str_replace('payment/proofs/', 'payment_proofs/', $this->payment_proof))
            ];
        } else {
            $possiblePaths = [
                // Storage disk paths
                'payment_proofs/' . $this->payment_proof,
                'payment/proofs/' . $this->payment_proof,
                'payment-proofs/' . $this->payment_proof,
                
                // Direct file system paths
                storage_path('app/public/payment_proofs/' . $this->payment_proof),
                storage_path('app/public/payment/proofs/' . $this->payment_proof),
                public_path('storage/payment_proofs/' . $this->payment_proof),
                public_path('storage/payment/proofs/' . $this->payment_proof)
            ];
        }

        foreach ($possiblePaths as $path) {
            // Check storage disk first
            if (strpos($path, storage_path()) === false && strpos($path, public_path()) === false) {
                if (Storage::disk('public')->exists($path)) {
                    Log::info('Payment proof exists via storage disk - PATH FIX: ' . $path);
                    return true;
                }
            }
            
            // Check direct file system
            if (file_exists($path)) {
                Log::info('Payment proof exists in file system - PATH FIX: ' . $path);
                return true;
            }
        }

        Log::warning('Payment proof does not exist anywhere - PATH FIX', [
            'payment_id' => $this->id,
            'file' => $this->payment_proof,
            'checked_paths' => $possiblePaths
        ]);

        return false;
    }

    // RELATIONSHIPS
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_email', 'email');
    }
}