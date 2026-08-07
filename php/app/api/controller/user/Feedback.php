<?php

namespace app\api\controller\user;

use app\api\IndexBaseController;
use app\service\admin\user\FeedbackService;
use think\App;
use think\Response;
use utils\Util;

class Feedback extends IndexBaseController
{
    protected FeedbackService $feedbackService;

    /**
     * 构造函数
     *
     * @param App $app
     * @param FeedbackService $feedbackService
     */
    public function __construct(App $app, FeedbackService $feedbackService)
    {
        parent::__construct($app);
        $this->feedbackService = $feedbackService;
    }

    /**
     * 订单咨询/留言列表
     * @return Response
     */
    public function list(): Response
    {
        $filter = $this->request->only([
            'page/d' => 1,
            'size/d' => 15,
            'is_order/d' => -1,
            'order_id/d' => 0,
            'product_id/d' => 0,
            'sort_field' => 'id',
            'sort_order' => 'desc',
        ], 'get');
        $filter["user_id"] = request()->userId;
        $result = $this->feedbackService->orderInquiryList($filter);
		$count = $this->feedbackService->getFilterCount($filter);
        return $this->success([
            'records' => $result,
            'total' => $count,
        ]);
    }

    /**
     * 提交留言
     * @return Response
     */
    public function submit(): Response
    {
        $data = $this->request->only([
            'type/d' => 0,
            'title' => '',
            'content' => '',
            'product_id/d' => 0,
            'order_id/d' => 0,
            'complaint_info' => '',
            'shop_id/d' => 0,
            'email' => '',
            'mobile' => '',
            'feedback_pics/a' => [],
        ], 'post');
        $result = $this->feedbackService->submitFeedback($data, request()->userId);
        return $result ? $this->success() : $this->error(/** LANG */ Util::lang('未知错误,提交失败'));
    }
}
