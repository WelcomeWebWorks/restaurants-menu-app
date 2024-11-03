<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    // Optional: Specify table if not the plural of model name
    protected $table = 'www_add_school_students';
    protected $primaryKey = 'student_id';

    // Optional: Define fillable fields for mass assignment
    protected $fillable = ['student_college_name', 'student_name', 'student_gender', 'student_personal_email', 'student_department', 'student_cgpa', 'student_contact_number'];

    // Optional: Disable timestamps if not using created_at/updated_at
    public $timestamps = false;
}
