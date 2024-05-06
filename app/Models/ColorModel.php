<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorModel extends Model
{
    use HasFactory;

    protected $table = 'color';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecord()
    {
        return self::select('color.*', 'users.name as created_by_name')
            ->Join('users', 'users.id', '=', 'color.created_by')
            ->where('color.is_deleted', '=', 0)
            ->orderBy('color.id', 'desc')
            ->get();
    }

    public static function getRecordActive()
    {
        return self::select('color.*')
            ->Join('users', 'users.id', '=', 'color.created_by')
            ->where('color.is_deleted', '=', 0)
            ->where('color.status', '=', 0)
            ->orderBy('color.name', 'asc')
            ->get();
    }
}
