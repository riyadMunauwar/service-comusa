<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;


class Transaction extends Model
{
    use HasFactory;


    protected $fillable = [
        'amount',
        'payment_method',
        'provider',
        'transaction_token',
        'transaction_status',
        'user_id'
    ];



    public function user() : BelongTo
    {
        return $this->belongsTo(User::class);
    }


}
