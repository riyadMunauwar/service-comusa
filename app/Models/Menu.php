<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Category;


class Menu extends Model
{
    use HasFactory;


    protected $fillable = [
        'type',
        'name',
        'link',
        'is_published',
        'cache_key',
        'category_id',
        'parent_id',
        'sort_order',
        'collection_id',
    ];



    public function collection() : BelongsTo
    {
        return $this->belongsTo(Menu::class, 'collection_id', 'id');
    }


    public function collectionItems() : HasMany
    {
        return $this->hasMany(Menu::class, 'collection_id', 'id');
    }


    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function parent() : BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }


    public function children() : HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

}
