<?php

namespace app\model\finance;

use think\Model;

class UserWithdrawAccount extends Model
{
    protected $pk = 'account_id';
    protected $table = 'user_withdraw_account';

    //账号类型
    const ACCOUNT_TYPE_BANK = 1;
    const ACCOUNT_TYPE_ALIPAY = 2;
    const ACCOUNT_TYPE_WECHAT = 3;

    const ACCOUNT_TYPE_NAME = [
        self::ACCOUNT_TYPE_BANK => '银行卡',
        self::ACCOUNT_TYPE_ALIPAY => '支付宝',
        self::ACCOUNT_TYPE_WECHAT => '微信',
    ];

    // 账号类型名称
    public function getAccountTypeNameAttr($value, $data): string
    {
        return self::ACCOUNT_TYPE_NAME[$data["account_type"]] ?? '';
    }
}
