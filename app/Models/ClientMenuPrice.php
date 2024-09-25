<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientMenuPrice extends Model
{
    use HasFactory;
    // Optional: Specify table if not the plural of model name
    protected $table = 'www_menu_price';

    // Optional: Define fillable fields for mass assignment
    protected $fillable = ['client_id', 'menu_id', 'menu_price'];

    // Optional: Disable timestamps if not using created_at/updated_at
    public $timestamps = false;
}


