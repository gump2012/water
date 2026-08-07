<?php

namespace app\model\authority;

use think\Model;
use utils\Time;

class AdminLog extends Model
{
    protected $pk = 'log_id';
    protected $table = 'admin_log';

    public function adminUser()
    {
        return $this->hasOne(AdminUser::class, 'admin_id', 'user_id')->bind(["username"]);
    }

    //日志时间
    public function getLogTimeAttr($value)
    {
        return Time::format($value);
    }
}
