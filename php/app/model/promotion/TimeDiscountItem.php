<?php

namespace app\model\promotion;

use app\model\product\Product;
use app\model\product\ProductSku;
use think\Model;
use utils\Time;

class TimeDiscountItem extends Model
{
    protected $pk = 'item_id';
    protected $table = 'time_discount_item';

    protected $json = ['sku_ids'];

    protected $jsonAssoc = true;

    public function getProductInfoAttr()
    {
        $product = Product::where('product_id', $this->product_id)->field(['product_name','product_sn','product_stock','product_price'])->find();
        $sku = [];
        if(!empty($this->sku_id))
        {
            $sku = ProductSku::where('sku_id', $this->sku_id)->field(['sku_data','sku_sn','sku_stock','sku_price'])->find();
        }
        return array_merge($product,$sku);
    }

    // 秒杀时间
    public function getStartTimeAttr($value)
    {
        return Time::format($value);
    }

    public function getEndTimeAttr($value)
    {
        return Time::format($value);
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'product_id', 'product_id');
    }

}
