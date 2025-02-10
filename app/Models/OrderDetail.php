<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primarykey = 'id';
    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'price',
        'amount'

    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
