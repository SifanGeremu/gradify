<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Result;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
