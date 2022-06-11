<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Build_own_menu_list extends Model
{
    use HasFactory;
    protected $fillable =[
        'build_menu_id',
        'build_menu_list_id',
        'build_menu_list_name'
    ];


    public function build_own_menu()
    {
        return $this->belongsTo(Build_own_menu::class, 'build_menu_id', 'id');
    }

}
