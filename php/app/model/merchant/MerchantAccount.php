<?php

namespace app\model\merchant;

use app\model\authority\AdminUser;
use app\model\user\User;
use think\Model;
use utils\Time;

class MerchantAccount extends Model
{
    protected $pk = 'account_id';
    protected $table = 'merchant_account';

    protected $createTime = 'add_time';
    protected $autoWriteTimestamp = 'int';

    protected $append = [
        'account_type_text',
    ];

    // 字段处理
    public function getAddTimeAttr($value): string
    {
        return Time::format($value);
    }

    const TYPE_LIST = [
        1 => '银行卡',
        2 => '支付宝',
        3 => '微信'
    ];


    public function getAccountTypeTextAttr($value, $data): string
    {
        return self::TYPE_LIST[$data['account_type']] ?: '';
    }

}
