<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'sub_category';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    static public function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
            ->where('sub_category.status', '=', 0)
            ->where('sub_category.is_deleted', '=', 0)
            ->first();
    }

    public static function getRecord()
    {
        return self::select('sub_category.*', 'users.name as created_by_name', 'category.name as category_name')
            ->Join('category', 'category.id', '=', 'sub_category.category_id')
            ->Join('users', 'users.id', '=', 'sub_category.created_by')
            ->where('sub_category.is_deleted', '=', 0)
            ->orderBy('sub_category.id', 'desc')
            ->paginate(10);
    }

    public static function getRecordSubCategory($category_id)
    {
        return self::select('sub_category.*')
            ->Join('users', 'users.id', '=', 'sub_category.created_by')
            ->where('sub_category.is_deleted', '=', 0)
            ->where('sub_category.status', '=', 0)
            ->where('sub_category.category_id', '=', $category_id)
            ->orderBy('sub_category.name', 'asc')
            ->get();
    }

    public function TotalProduct()
    {
        return $this->hasMany(ProductModel::class, 'sub_category_id')
            ->where('product.status', '=', 0)
            ->where('product.is_deleted', '=', 0)
            ->count();
    }
}
