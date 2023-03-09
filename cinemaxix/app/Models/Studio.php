<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'basic_price',
        'additional_friday_price',
        'additional_saturday_price',
        'additional_sunday_price',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'studio_id', 'id');
    }
}
