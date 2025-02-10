<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'item';
    protected $primarykey = 'id';
    protected $foreignkey = 'category_id';
    protected $fillable = [
        'name',
        'category_id',
        'price'

    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
