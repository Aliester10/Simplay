<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_id',
        'name',
        'email',
        'phone',
        'address',
        'cover_letter',
        'cv_path',
        'status',
        'admin_notes',
        'portfolio_url',
        'expected_salary',
        'notice_period',
        'linkedin_profile'
    ];

    public function position()
    {
        return $this->belongsTo(CareerPosition::class, 'position_id');
    }
}