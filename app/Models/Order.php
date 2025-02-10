<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primarykey = 'id';
    protected $foreignkey = 'item_id';
    protected $fillable = [
        'order_code',
        'date',
        'customer_name',
        'discount',
        'total'

    ];

    public function order_detail()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id');
    }
}
