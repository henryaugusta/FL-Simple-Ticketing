<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketModel extends Model
{
    protected $table ="tickets";
    use HasFactory;

    
    protected $append = ['operator'];
    
    function getOperatorAttribute()
    {
        return User::find($this->delegate_id);
    }
}
