<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecord()
    {
        return self::select('orders.*')
            ->where('orders.is_deleted', '=', 0)
            ->orderBy('orders.id', 'desc')
            ->get();
    }

    public static function getRecordActive()
    {
        return self::select('orders.*')
            ->where('orders.is_deleted', '=', 0)
            ->where('orders.status', '=', 0)
            ->orderBy('orders.id', 'asc')
            ->get();
    }

    public function getItem()
    {
        return $this->hasMany(OrderItemModel::class, 'order_id');
    }

}
