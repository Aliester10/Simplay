<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BidangPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'bidang_perusahaan';

    protected $fillable = ['name'];

    /**
     * Relasi satu ke banyak dengan model User.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'bidang_id');
    }
}
