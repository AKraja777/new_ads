<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class staffs extends Model
{
    protected $table = 'staffs'; // Specify the table name if it's different from the model name

    public function branches()
    {
        return $this->belongsTo(branches::class, 'branches_id');
    }
}

