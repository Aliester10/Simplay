<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    use HasFactory;

    // Tambahkan properti atau relasi model sesuai kebutuhan
    protected $fillable = ['nama', 'deskripsi', 'gambar']; // Sesuaikan
}
