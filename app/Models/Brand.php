<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // Pastikan tabel sudah ada dengan nama yang sesuai, atau tentukan jika berbeda
    protected $table = 'brands';

    // Jika hanya perlu nama dan logo
    protected $fillable = ['name', 'logo'];
}
