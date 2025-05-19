<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandPartner extends Model
{
    use HasFactory;

    protected $table = 'brand_partner';

    // Mass assignable attributes
    protected $fillable = [
        'gambar',
        'type',
        'url',
        'nama',
    ];

}
