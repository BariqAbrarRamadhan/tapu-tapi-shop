<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemModel extends Model
{
    use HasFactory;

    protected $table = 'orders_item';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public function getProduct()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    // public static function getRecord()
    // {
    //     return self::select('orders_item.*')
    //         // ->where('orders_item.is_deleted', '=', 0)
    //         ->orderBy('orders_item.id', 'desc')
    //         ->get();
    // }

    // public static function getRecordActive()
    // {
    //     return self::select('orders_item.*')
    //         // ->where('orders_item.is_deleted', '=', 0)
    //         // ->where('orders_item.status', '=', 0)
    //         ->orderBy('orders_item.id', 'asc')
    //         ->get();
    // }

}
