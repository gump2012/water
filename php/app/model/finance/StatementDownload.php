<?php

namespace app\model\finance;

use think\Model;

class StatementDownload extends Model
{
    protected $pk = 'statement_download_id';
    protected $table = 'statement_download';
    protected $createTime = 'gmt_create';
    protected $autoWriteTimestamp = true;

}
