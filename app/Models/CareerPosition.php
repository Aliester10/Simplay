<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerPosition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'category',
        'location',
        'type',
        'description',
        'requirements',
        'responsibilities',
        'benefits',
        'salary_range',
        'application_deadline',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'application_deadline' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the applications for the position.
     */
    public function applications()
    {
        return $this->hasMany(CareerApplication::class, 'position_id');
    }
}