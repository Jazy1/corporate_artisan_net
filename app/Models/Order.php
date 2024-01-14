<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelancer_id', 'company_id', 'gig_id', 'amount', 'description', 'time', 'status', 'number'
    ];

    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }
}
