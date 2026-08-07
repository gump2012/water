<?php

namespace app\adminapi\controller\decorate;

use app\adminapi\AdminBaseController;
use app\service\admin\decorate\DecorateRequestService;
use app\service\admin\decorate\DecorateService;
use think\App;
use think\Response;

/**
 * 装修控制器
 */
class DecorateRequest extends AdminBaseController
{
    protected DecorateService $decorateService;

    /**
     * 构造函数
     *
     * @param App $app
     * @param DecorateService $decorateService
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->checkAuthor('decorateManage'); //权限检查
    }

    /**
     * 获取商品列表
     * @return Response
     * @throws \exceptions\ApiException
     */
    public function productList():Response
    {
        $params = $this->request->only([
            'size/d' => 0,
            'page/d' => 1,
            'product_select_type/d' => 0,
            'product_ids/a' => [],
            'product_category_id/d' => 0,
            'product_tag' => '',
            'product_number' => 3,
            'shop_id' => $this->shopId
        ], 'get');
        // 后台装修最多只显示20个
        if ($params['product_select_type'] == 1) {
            $params['product_number'] = 20;
        } else {
            $params['product_number'] = $params['product_number'] > 20 ? 20 : $params['product_number'];
        }

        $product_list = app(DecorateRequestService::class)->getProductList($params);
        return $this->success(
             $product_list
        );
    }

	/**
	 * 获取装修模块数据
	 * @return Response
	 * @throws \exceptions\ApiException
	 */
	public function decorateByModule():Response
	{
		$params = $this->request->only([
			'size/d' => 10,
			'page/d' => 1,
			'decorate_id/d' => 0,
			'module_type' => '',
		], 'get');

		$item = app(DecorateRequestService::class)->getDecorateByModule($params);
		return $this->success(
			 $item
		);
	}

}
