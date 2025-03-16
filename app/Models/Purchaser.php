<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchaser extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',              
        'email',             
        'shipping_address',  
        'product_id',
        'product_name',
        'payments',
        'payment_status',
        'payment_mode',
        'quantity',
        'status',           
        'purchaser_uuid',
    ];
}
