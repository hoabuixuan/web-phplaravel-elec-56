<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'code_order',
        'user_id',
        'name',
        'address',
        'email',
        'phone',
        'monney',
        'message',
        'status'
    ];
}
