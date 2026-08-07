<?php

namespace app\api\controller\user;

use app\api\IndexBaseController;
use app\service\admin\user\UserMessageService;
use think\App;
use think\Response;
use utils\Util;

/**
 * 我的站内信控制器
 */
class Message extends IndexBaseController
{
    protected UserMessageService $userMessageService;
    /**
     * 构造函数
     *
     * @param App $app
     */
    public function __construct(App $app, UserMessageService $userMessageService)
    {
        parent::__construct($app);
        $this->userMessageService = $userMessageService;
    }

    /**
     * 会员站内信列表
     * @return Response
     */
    public function list(): Response
    {
        $filter = $this->request->only([
            'page/d' => 1,
            'size/d' => 15,
            'unread/d' => 0,
        ], 'get');
        $filterResult = $this->userMessageService->getFilterResult($filter);
        $total = $this->userMessageService->getFilterCount($filter);
        return $this->success([
            'records' => $filterResult,
            'total' => $total,
        ]);
    }

    /**
     * 全部标记已读
     * @return Response
     * @throws \exceptions\ApiException
     */
    public function updateAllRead(): Response
    {
        $result = $this->userMessageService->updateUserMessageToAllRead(request()->userId);
        return $result ? $this->success() : $this->error(/** LANG */ Util::lang("添加失败"));
    }

    /**
     * 设置站内信已读
     * @return Response
     * @throws \exceptions\ApiException
     */
    public function updateMessageRead(): Response
    {
        $id = $this->request->all('id/d', 0);
        $result = $this->userMessageService->updateUserMessageToRead($id, request()->userId);
        return $result ? $this->success() : $this->error(/** LANG */ Util::lang("添加失败"));
    }

    /**
     * 删除站内信
     * @return Response
     * @throws \exceptions\ApiException
     */
    public function del(): Response
    {
        $id = $this->request->all('id/d', 0);
        $result = $this->userMessageService->deleteUserMessage($id, request()->userId);
        return $result ? $this->success() : $this->error(/** LANG */ Util::lang('删除失败'));
    }

}
