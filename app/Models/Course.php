<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table='courses';
    protected $fillable = ['title', 'description', 'price', 'status'];
    public function subscribe()
    {
        return $this->hasOne(Subscribe::class);
    }
}
