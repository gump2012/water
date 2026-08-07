<?php

namespace app\service\admin\user;

use app\service\common\BaseService;
use exceptions\ApiException;

/**
 * 会员登录服务类
 */
class UserLoginService extends BaseService
{
    public function __construct()
    {
    }
    /**
     * 删除会员
     *
     * @param int $id
     * @return bool
     */
    public function login(string $username, string $password, $is_remember = null)
    {
        if (!$id) {
            throw new ApiException('#id错误');
        }
        return $result !== false;
    }
}
