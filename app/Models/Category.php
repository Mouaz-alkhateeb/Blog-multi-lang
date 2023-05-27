<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;


class Category extends Model implements TranslatableContract
{
    use Translatable, HasFactory, SoftDeletes, HasEagerLimit;
    public $translatedAttributes = ['title', 'content', 'slug'];
    protected $fillable = ['id', 'image', 'parent'];
    protected $table = 'categories';


    public function parents()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
