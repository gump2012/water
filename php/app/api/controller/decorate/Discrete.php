<?php

namespace app\api\controller\decorate;

use app\api\IndexBaseController;
use app\service\admin\decorate\DecorateDiscreteService;
use think\App;
use think\Response;

/**
 * 装修组件控制器
 */
class Discrete extends IndexBaseController
{
    /**
     * 构造函数
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * 获取开屏广告
     *
     * @return Response
     */
    public function getOpenAdvertising(): Response
    {

        $decorateSn = $this->request->param('decorate_sn', 'openAdvertising');
        $item = app(DecorateDiscreteService::class)->getDetail($decorateSn);
        if (is_null($item)){
            return $this->success();
        }
        return $this->success($item['data']);

    }


}