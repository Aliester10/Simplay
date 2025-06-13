<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
        'payment_instructions',
        'status',
        'qr_img',
        'qr_image' // ADD THIS FIELD
    ];

    /**
     * Get active payment settings
     */
    public static function getActiveSettings()
    {
        return self::where('status', 'active')->first() ?? self::first();
    }

    /**
     * Get QR image information for API response
     */
    public function getQrImageDataAttribute()
    {
        // First check if there's an active QRIS image from qris_images table
        $qrisImage = QrisImage::where('status', 'active')->first();
        if ($qrisImage) {
            return [
                'id' => $qrisImage->id,
                'name' => $qrisImage->name,
                'image_path' => $qrisImage->image_path,
                'full_url' => asset('storage/' . $qrisImage->image_path),
                'status' => $qrisImage->status
            ];
        }
        
        // Fallback to blob data if no file-based QR exists
        if ($this->qr_img) {
            return [
                'id' => $this->id,
                'name' => 'QR Payment Code',
                'image_path' => null,
                'full_url' => 'data:image/png;base64,' . base64_encode($this->qr_img),
                'status' => 'active'
            ];
        }
        
        return null;
    }

    /**
     * Get QR image as base64 if stored as blob (backward compatibility)
     */
    public function getQrImageAttribute()
    {
        if ($this->qr_img) {
            // If stored as blob in database
            return 'data:image/png;base64,' . base64_encode($this->qr_img);
        }
        
        // Check if there's an active QRIS image from qris_images table
        $qrisImage = QrisImage::where('status', 'active')->first();
        if ($qrisImage) {
            return asset('storage/' . $qrisImage->image_path);
        }
        
        return null;
    }

    /**
     * Check if QR image is available
     */
    public function hasQrImage()
    {
        return $this->qr_img || QrisImage::where('status', 'active')->exists();
    }

    /**
     * Check if payment system is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Get bank details for display
     */
    public function getBankDetailsAttribute()
    {
        return [
            'bank_name' => $this->bank_name,
            'account_number' => $this->account_number,
            'account_name' => $this->account_name
        ];
    }

    /**
     * Get complete payment configuration for API
     */
    public function getApiConfigurationAttribute()
    {
        return [
            'bank_details' => $this->bank_details,
            'payment_instructions' => $this->payment_instructions,
            'qr_image' => $this->qr_image_data,
            'status' => $this->status,
            'has_qr' => $this->hasQrImage()
        ];
    }
}