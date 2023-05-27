<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Post extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes, HasEagerLimit;
    public $translatedAttributes = ['title', 'content', 'small_desc', 'tags'];
    protected $fillable = ['id', 'image', 'category_id', 'user_id'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}