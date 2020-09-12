<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $dates = ['used_on'];

    protected $fillable = ['offer_id', 'recipient_id', 'code'];

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
