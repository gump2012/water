<?php

namespace app\model\promotion;

use app\model\product\Product;
use app\model\product\ProductSku;
use think\Model;

class SeckillItem extends Model
{
    protected $pk = 'rec_id';
    protected $table = 'seckill_item';

    // 关联商品规格
    public function productSku()
    {
        return $this->hasOne(ProductSku::class, 'sku_id', 'sku_id')->bind(["sku_data","sku_stock","sku_price","sku_sn"]);
    }
    public function product()
    {
        return $this->hasOne(Product::class, 'product_id', 'product_id')->bind(["product_name","product_stock","product_price","product_sn"]);
    }
}
