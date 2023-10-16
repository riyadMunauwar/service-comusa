<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Service;
use App\Models\User;


class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'total',
        'qty',
        'order_type',
        'serial_number',
        'device',
        'order_note',
        'email',
        'phone',
        'name',
        'order_status',
        'payment_status',
        'service_id',
        'user_id',
    ];



    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function attributes(): MorphMany
    {
        return $this->MorphMany(Attribute::class, 'attributable');
    }
}
