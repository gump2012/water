<?php

namespace app\adminapi\controller\product;

use app\adminapi\AdminBaseController;
use app\service\admin\product\ProductInventoryLogService;
use think\App;

/**
 * 商品库存日志控制器
 */
class ProductInventoryLog extends AdminBaseController
{
    protected ProductInventoryLogService $productInventoryLogService;

    /**
     * 构造函数
     *
     * @param App $app
     * @param ProductInventoryLogService $productInventoryLogService
     */
    public function __construct(App $app, ProductInventoryLogService $productInventoryLogService)
    {
        parent::__construct($app);
        $this->productInventoryLogService = $productInventoryLogService;
        //$this->checkAuthor('productInventoryLogManage'); //权限检查
    }

    /**
     * 列表页面
     *
     * @return \think\Response
     */
    public function list(): \think\Response
    {
        $filter = $this->request->only([
            'keyword' => '',
			'type/d' => 0,
            'page/d' => 1,
            'size/d' => 15,
            'sort_field' => 'log_id',
            'sort_order' => 'desc',
        ], 'get');

        if (request()->adminType = 'shop') {
            $filter['shop_id'] = request()->shopId;
        }

        $filterResult = $this->productInventoryLogService->getFilterResult($filter);
        $total = $this->productInventoryLogService->getFilterCount($filter);

        return $this->success([
            'records' => $filterResult,
            'total' => $total,
        ]);
    }

//    /**
//     * 删除
//     *
//     * @return \think\Response
//     */
//    public function del(): \think\Response
//    {
//        $id =$this->request->all('id/d', 0);
//        $this->productInventoryLogService->deleteProductInventoryLog($id);
//        return $this->success('指定项目已删除');
//    }

//    /**
//     * 批量操作
//     *
//     * @return \think\Response
//     */
//    public function batch(): \think\Response
//    {
//        if (empty($this->request->all('ids')) || !is_array($this->request->all('ids'))) {
//            return $this->error('未选择项目');
//        }
//
//        if ($this->request->all('type') == 'del') {
//            foreach ($this->request->all('ids') as $key => $id) {
//                $id = intval($id);
//                $this->productInventoryLogService->deleteProductInventoryLog($id);
//            }
//            return $this->success('批量操作执行成功！');
//        } else {
//            return $this->error('#type 错误');
//        }
//    }
}
