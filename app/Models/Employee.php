<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
