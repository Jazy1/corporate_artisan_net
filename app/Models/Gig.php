<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelancer_id',
        'title',
        'description',
        'category_id',
        'price',
        'images',
        'uuid',
        'status',
    ];

    protected $casts = [
        'images' => 'json',
    ];

    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
