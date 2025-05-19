<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';

    // Define the fillable fields
    protected $fillable = [
        'image_url',
        'title',
        'subtitle',
        'description',
        'button_text',
        'button_url',
    ];
}
