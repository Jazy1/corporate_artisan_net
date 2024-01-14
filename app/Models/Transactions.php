<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'from',
        'to',
        'amount',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'from', 'id');
    }

    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class, 'to', 'id');
    }

}
