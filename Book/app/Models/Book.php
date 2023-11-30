<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Book extends Model
{
    use HasApiTokens,HasFactory;
    protected $table="books";
    protected $fillable=[
        'name',
        'desc',
        'price',
    ];
    public $timestamp=false;
}
