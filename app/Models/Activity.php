<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'image',
        'date',
        'title',
        'description',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
    
    public function images()
    {
        return $this->hasMany(ActivityImage::class);
    }
}