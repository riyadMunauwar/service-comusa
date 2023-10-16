<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Service;


class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'description',
        'is_featured',
        'is_published',
        'parent_id',
        'meta_title',
        'meta_tags',
        'meta_description',
        'cache_key'
    ];


    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }


    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }


    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }


    public function menu() : HasOne
    {
        return $this->hasOne(Menu::class);
    }
}
