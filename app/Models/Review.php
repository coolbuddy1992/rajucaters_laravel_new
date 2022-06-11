<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "name",
        "review_comments",
        "rating",
        "review_image",
        "public_id",
        "review_type",
        "email",
        "phone",
        "product_detail",
        "product_id"
    ];
}
