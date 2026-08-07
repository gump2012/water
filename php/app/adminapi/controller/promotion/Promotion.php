<?php

namespace app\adminapi\controller\promotion;

use app\adminapi\AdminBaseController;
use app\service\admin\promotion\PromotionService;
use think\App;
use think\Response;

/**
 * 活动管理控制器
 */
class Promotion extends AdminBaseController
{
    protected PromotionService $promotionService;

    /**
     * 构造函数
     *
     * @param App $app
     * @param PromotionService $promotionService
     */
    public function __construct(App $app, PromotionService $promotionService)
    {
        parent::__construct($app);
        $this->promotionService = $promotionService;
    }

    /**
     * 列表页面
     *
     * @return Response
     */
    public function list(): Response
    {
        $filter = $this->request->only([
            'time_type/d' => 0,
            'type' => "",
            'sort_field' => 'promotion_id',
            'sort_order' => 'desc',
            'page' => 1,
            'size' => 15,
        ], 'get');
        $filter['shop_id'] = request()->shopId;
        $filter['is_delete'] = 0;
        $filter['is_available'] = 1;
        $filterResult = $this->promotionService->getFilterList($filter, [], ['type_text', 'time_text']);
        $total = $this->promotionService->getFilterCount($filter);

        return $this->success([
            'records' => $filterResult,
            'total' => $total,
        ]);
    }

    /**
     * 获取活动数量
     * @return Response
     */
    public function getPromotionCount()
    {
        return $this->success([
            'timeType1Count' => $this->promotionService->getFilterCount([
                'is_available' => 1,
                'is_delete' => 0,
                'time_type' => 1,
                'shop_id' => request()->shopId
            ]),
            'timeType2Count' => $this->promotionService->getFilterCount([
                'is_delete' => 0,
                'is_available' => 1,
                'time_type' => 2,
                'shop_id' => request()->shopId
            ]),
            'timeType3Count' => $this->promotionService->getFilterCount([
                'is_available' => 1,
                'is_delete' => 0,
                'time_type' => 3,
                'shop_id' => request()->shopId
            ]),
        ]);
    }
}
