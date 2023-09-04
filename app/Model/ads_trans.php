<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ads_trans extends Model
{
    protected $table = 'ads_trans'; // Specify the table name if it's different from the model name

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

