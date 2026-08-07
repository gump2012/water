<?php
namespace app\adminapi\controller\common;

use app\BaseController;
use tig\CacheManager;

class CacheManage extends BaseController
{

    public function __construct()
    {
    }

    public function cleanup()
    {
        $tag = input('tag', 'all');
        app(CacheManager::class)->clearCacheByTag($tag);
        return $this->success();
    }
}
