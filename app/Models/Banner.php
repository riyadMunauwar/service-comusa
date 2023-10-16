<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    protected $fillable = [
        'title',
        'sub_title_1',
        'sub_title_2',
    ];


    public function bannerUrl()
    {
        if($this->hasMedia('banner'))
        {
            return $this->getFirstMedia('banner')->getUrl();
        }
    }

}
