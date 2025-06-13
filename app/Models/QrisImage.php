<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class QrisImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'filename',
        'status'
    ];

    protected $appends = ['image_url', 'full_url'];

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    public function getFullUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    public static function getActiveImages()
    {
        return self::where('status', 'active')->get();
    }

    public static function getActiveImage()
    {
        return self::where('status', 'active')->first();
    }

    /**
     * Check if image file exists
     */
    public function fileExists()
    {
        return Storage::disk('public')->exists($this->image_path);
    }

    /**
     * Get image data for API response
     */
    public function getApiDataAttribute()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image_path' => $this->image_path,
            'full_url' => $this->full_url,
            'status' => $this->status,
            'file_exists' => $this->fileExists()
        ];
    }
}