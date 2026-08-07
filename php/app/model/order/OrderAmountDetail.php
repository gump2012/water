<?php

namespace app\model\order;

use app\model\authority\AdminUser;
use app\model\user\User;
use think\Model;
use utils\Time;

class OrderAmountDetail extends Model
{
    protected $pk = 'order_amount_detail_id';
    protected $table = 'order_amount_detail';

    protected $createTime = false;
    protected $updateTime = false;
}
