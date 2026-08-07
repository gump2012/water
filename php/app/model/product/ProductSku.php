<?php

namespace app\model\product;

use think\Model;

class ProductSku extends Model
{
    protected $pk = 'sku_id';
    protected $table = 'product_sku';
    protected $json = ['sku_data'];
    // 设置JSON数据返回数组
    protected $jsonAssoc = true;

    public function product()
    {
        return $this->belongsTo('app\model\product\Product', 'product_id', 'product_id');
    }
}
