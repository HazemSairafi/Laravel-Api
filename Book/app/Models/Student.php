<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model implements AuthenticatableContract
{
    use HasApiTokens,HasFactory,Authenticatable;

    protected $table="students";
    protected $fillable=[
        'name',
        'email',
        'password',
        'phone',
    ];
    public $timestamp=false;

    public function book(){
        return $this->hasMany(Book::class);
    }
}
