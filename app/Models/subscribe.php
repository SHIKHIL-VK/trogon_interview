<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subscribe extends Model
{
    protected $table='subscribe';
    protected $fillable=['user_id','course_id','status'];
    public function course()
    {
        return $this->belongsTo(course::class);
    }
}
