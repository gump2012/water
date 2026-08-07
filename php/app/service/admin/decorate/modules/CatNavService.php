<?php

namespace app\service\admin\decorate\modules;

use app\service\admin\decorate\MobileCatNavService;
use app\service\common\BaseService;
use exceptions\ApiException;

/**
 * 装修服务类
 */
class CatNavService extends BaseService
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
    public function formatData(array $module): array
    {

        $filterResult = app(MobileCatNavService::class)->getFilterResult([
            'is_show' => 1,
        ]);
        $module['nav_list'] = $filterResult;
        return $module;
    }

}
