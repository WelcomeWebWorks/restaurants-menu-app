<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    // Optional: Specify table if not the plural of model name
    protected $table = 'www_clients';

    // Optional: Define fillable fields for mass assignment
    protected $fillable = ['client_name', 'client_domain_name', 'client_contact1'];

    // Optional: Disable timestamps if not using created_at/updated_at
    public $timestamps = false;
}
