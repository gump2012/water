<?php

namespace app\model\merchant;

use app\model\user\User;
use think\Model;
use utils\Time;

class ShopAccountLog extends Model
{
    protected $pk = 'shop_account_log_id';
    protected $table = 'shop_account_log';

    protected $createTime = 'add_time';
    protected $autoWriteTimestamp = 'int';

    // 字段处理
    public function getAddTimeAttr($value): string
    {
        return Time::format($value);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'shop_id')->bind(['shop_title','un_settlement_order']);
    }

}
