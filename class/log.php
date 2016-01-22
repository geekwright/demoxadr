<?php

use Xoops\Core\Database\Connection;
use Xoops\Core\Kernel\Dtype;
use Xoops\Core\Kernel\XoopsObject;
use Xoops\Core\Kernel\XoopsPersistableObjectHandler;

class DemoxadrLog extends XoopsObject
{
    public function __construct()
    {
        $this->initVar('log_id', Dtype::TYPE_INTEGER, 0, true);
        $this->initVar('log_todo_id', Dtype::TYPE_INTEGER, 0, false);
        $this->initVar('log_start_time', Dtype::TYPE_INTEGER, 0, false);
        $this->initVar('log_end_time', Dtype::TYPE_INTEGER, 0, false);
        $this->initVar('log_work_time', Dtype::TYPE_INTEGER, 0, false);
    }

    /**
     * updateWorkTime - calculate the working time
     *
     * @return void
     */
    public function updateWorkTime()
    {
        $this->setVar('log_work_time', ($this->getVar('log_end_time') - $this->getVar('log_start_time')) );
    }
}

class DemoxadrLogHandler extends XoopsPersistableObjectHandler
{
    public function __construct(Connection $db)
    {
        parent::__construct($db, 'demoxadr_log', 'DemoxadrLog', 'log_id');
    }
}
