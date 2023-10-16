<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Category;
use App\Models\Attribute;

class Service extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'youtube_video_id',
        'description',
        'delivery_time',
        'is_bulk_order_allowed',
        'order_type',
        'service_type',
        'is_submit_to_verified_allowed',
        'is_cancelation_allowed',
        'order_processing',
        'is_featured',
        'is_published',
        'meta_title',
        'meta_tags',
        'meta_description'
    ];


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }



    public function attributes(): MorphMany
    {
        return $this->MorphMany(Attribute::class, 'attributable');
    }



    public function thumbnailUrl()
    {
        if($this->hasMedia('thumbnail'))
        {
            return $this->getFirstMedia('thumbnail')->getUrl();
        }
    }

}
