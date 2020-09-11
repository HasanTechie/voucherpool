<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $dates = ['expiry'];

    public function codes()
    {
        return $this->hasMany(Code::class);
    }
}
