<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $table = 'transaction'; // Specify the table name if it's different from the model name

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

