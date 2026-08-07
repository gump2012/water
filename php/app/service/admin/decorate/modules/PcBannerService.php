<?php

namespace app\service\admin\decorate\modules;

use app\service\admin\user\UserService;
use app\service\common\BaseService;
use exceptions\ApiException;

/**
 * 装修服务类
 */
class PcBannerService extends BaseService
{
    public function __construct()
    {
    }
    /**
     * 模块数据格式化
     *
     * @param array $module
     * @return array
     * @throws ApiException
     */
    public function formatData(array $module, array $params = null): array
    {
        $module['avatar'] = app(UserService::class)->getUserAvatar();
        return $module;
    }

}
