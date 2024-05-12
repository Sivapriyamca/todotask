<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Todo;

class Project extends Model
{
    use HasFactory;
    // public function tasks(){
    //     return $this->hasMany(Todo::class);
    // }
}
