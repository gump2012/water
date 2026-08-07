<?php

namespace app\model\authority;

use app\model\merchant\AdminUserShop;
use app\model\user\User;
use think\Model;
use utils\Time;

class AdminUserVendor extends Model
{
    protected $pk = 'id';
    protected $table = 'admin_user_vendor';
    protected $createTime = "add_time";
    protected $autoWriteTimestamp = true;
    protected $json = ["auth_list"];
    // 设置JSON数据返回数组
    protected $jsonAssoc = true;

}
