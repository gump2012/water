<?php

namespace app\model\product;

use think\Model;
use utils\Time;

class ProductInventoryLog extends Model
{
    protected $pk = 'log_id';
    protected $table = 'product_inventory_log';
    protected $createTime = "add_time";
    protected $autoWriteTimestamp = true;

    // 商品关联
    public function product()
    {
        return $this->hasOne(Product::class, 'product_id', 'product_id')->bind(["product_name"]);
    }

    public function getAddTimeAttr($value)
    {
        return Time::format($value);
    }

    // 商品名称检索
    public function scopeProductName($query, $value)
    {
        return $query->hasWhere('product', function ($query) use ($value) {
            $query->where('product_name', 'like', '%' . $value . '%');
        });
    }
}
