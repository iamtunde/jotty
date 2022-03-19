<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jot extends Model
{
    use HasFactory;

    protected $table = 'jots';

    protected $fillable = ['title', 'content', 'color', 'status'];
}
