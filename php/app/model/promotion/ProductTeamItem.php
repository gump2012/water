<?php

namespace app\model\promotion;

use app\model\product\ProductSku;
use think\Model;

class ProductTeamItem extends Model
{
    protected $pk = 'product_team_item_id';
    protected $table = 'product_team_item';

    // 关联商品规格
    public function productSku()
    {
        return $this->hasOne(ProductSku::class, 'sku_id', 'sku_id')->field([
            "sku_data",
            "sku_stock",
            "sku_price",
            "sku_sn"
        ]);
    }
}
