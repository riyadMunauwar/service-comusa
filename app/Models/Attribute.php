<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'attributable_type',
        'attributable_id'
    ];

    public function attributable() : MorphTo
    {
        return $this->morphTo();
    }

}
