<?php

namespace app\model\order;

use app\model\authority\AdminUser;
use app\model\user\User;
use think\Model;
use utils\Time;

class OrderCouponDetail extends Model
{
    protected $pk = 'order_coupon_detail_id';
    protected $table = 'order_coupon_detail';

    protected $createTime = false;
    protected $updateTime = false;
}
