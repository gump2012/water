<?php

namespace app\model\shipping;

use app\model\merchant\Shop;
use think\Model;

class ShippingTpl extends Model
{
    protected $pk = 'shipping_tpl_id';
    protected $table = 'shipping_tpl';

	public function shop()
	{
		return $this->hasOne(Shop::class, 'shop_id', 'shop_id')
			->field(["shop_id","shop_title","status"]);
	}
}
