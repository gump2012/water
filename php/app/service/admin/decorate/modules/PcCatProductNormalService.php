<?php

namespace app\service\admin\decorate\modules;

use app\service\admin\product\CategoryService;
use app\service\common\BaseService;
use exceptions\ApiException;

/**
 * 装修服务类
 */
class PcCatProductNormalService extends BaseService
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
        if (isset($module['category_id']) && !empty($module['category_id'])) {
            $module['child_category_list'] = app(CategoryService::class)->getChildCategoryList($module['category_id']);
        }
        return $module;
    }

}
