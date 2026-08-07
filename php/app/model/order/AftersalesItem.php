<?php

namespace app\model\order;

use think\Model;

class AftersalesItem extends Model
{
    protected $pk = 'aftersales_item_id';
    protected $table = 'aftersales_item';

    public function items()
    {
        return $this->hasOne(OrderItem::class, 'item_id', 'order_item_id')->bind(['order_sn', 'product_name', 'order_id', 'pic_thumb', 'product_sn', "product_id", 'quantity', 'price']);
    }

    public function aftersales()
    {
        return $this->hasOne(Aftersales::class, 'aftersale_id', 'aftersale_id')->bind(["status"]);
    }
}
