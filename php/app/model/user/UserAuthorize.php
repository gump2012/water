<?php

namespace app\model\user;

use think\Model;

class UserAuthorize extends Model
{
    protected $pk = 'authorize_id';
    protected $table = 'user_authorize';
    protected $createTime = "add_time";
    protected $autoWriteTimestamp = true;
    protected $json = ['open_data'];
    protected $jsonAssoc = true;

    public function getOpenDataAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }

    public function setOpenDataAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }

    // 授权类型
    const AUTHORIZE_TYPE_WECHAT = 1;
    const AUTHORIZE_TYPE_ALIPAY = 3;
    const AUTHORIZE_TYPE_QQ = 4;
    const AUTHORIZE_TYPE_MINI_PROGRAM = 2;

    //google
    const AUTHORIZE_TYPE_GOOGLE = 101;

    //facebook
    const AUTHORIZE_TYPE_FACEBOOK = 102;

    const AUTHORIZE_TYPE_NAME = [
        self::AUTHORIZE_TYPE_WECHAT => '微信',
        self::AUTHORIZE_TYPE_ALIPAY => '支付宝',
        self::AUTHORIZE_TYPE_QQ => 'QQ',
        self::AUTHORIZE_TYPE_MINI_PROGRAM => '小程序',
        self::AUTHORIZE_TYPE_GOOGLE => 'google',
        self::AUTHORIZE_TYPE_FACEBOOK => 'facebook',
    ];


    //通过名称获得typeId
    public static function getAuthorizeTypeIdByName($name)
    {
        foreach (self::AUTHORIZE_TYPE_NAME as $key => $value) {
            if ($value == $name) {
                return $key;
            }
        }
        return 0;
    }

    public function getAuthorizeTypeNameAttr($value, $data)
    {
        return self::AUTHORIZE_TYPE_NAME[$data['authorize_type']] ?? "";
    }
}
