<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    public function course()
    {
        return $this->belongsTo(course::class, 'course_id');
    }
}
