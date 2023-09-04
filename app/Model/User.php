<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table = 'users'; // Specify the table name if it's different from the model name

    public function staffs()
    {
        return $this->belongsTo(staffs::class, 'staffs_id');
    }
    public function branches()
    {
        return $this->belongsTo(branches::class, 'branch_id');
    }
}

