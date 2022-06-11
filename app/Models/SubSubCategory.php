<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        "subsubcategory_name_en",
        "subsubcategory_name_hi",
        "subsubcategory_slug_en",
        "subsubcategory_slug_hi",
        "category_id",
        "subcategory_id",
        "subsubcategory_image",
        "public_id"
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function subcategory()
    {
        return $this->hasOne(SubCategory::class, 'id', 'subcategory_id');
    }

    public function products(){
        return $this->hasMany(Product::class,'sub_subcategory_id','id');
    }
}
