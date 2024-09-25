<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    // Optional: Specify table if not the plural of model name
    protected $table = 'www_menu';

    // Optional: Define fillable fields for mass assignment
    protected $fillable = ['menu_name', 'menu_image', 'menu_description', 'menu_type', 'menu_category'];

    // Optional: Disable timestamps if not using created_at/updated_at
    public $timestamps = false;
}
