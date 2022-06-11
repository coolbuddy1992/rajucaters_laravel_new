<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name_en',
        'category_name_hi',
        'category_slug_en',
        'category_slug_hi',
        'category_icon',
        'category_image',
        'public_id'
    ];

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    public function subsubcategory()
    {
        return $this->hasMany(SubSubCategory::class, 'category_id', 'id');
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
}
