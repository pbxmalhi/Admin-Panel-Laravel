<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminPage extends Model
{
    use HasFactory;
    protected $table = "page";
    public $timestamps = false;
}
