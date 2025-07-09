<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerCategory extends Model
{
    use HasFactory;

    protected $table = 'career_categories'; // atau nama tabel kamu

    protected $fillable = [
        'category',
    ];

}