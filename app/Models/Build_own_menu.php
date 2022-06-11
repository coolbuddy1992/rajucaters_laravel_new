<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Build_own_menu extends Model
{
    use HasFactory;

    protected $fillable =[
        'menu_name_en',
        'menu_name_hi',
        'slug_en',
        'slug_hi',
        'status',
    ];

    public function build_own_menu_list()
    {
        return $this->hasMany(Build_own_menu_list::class, 'build_menu_id');
    }

}
