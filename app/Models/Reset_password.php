<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reset_password extends Model
{
    protected $table = "password_resets";
    use HasFactory;
}
