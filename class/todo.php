<?php

use Xoops\Core\Database\Connection;
use Xoops\Core\Kernel\XoopsObject;
use Xoops\Core\Kernel\XoopsPersistableObjectHandler;

class DemoxadrTodo extends XoopsObject
{
    public function __construct($id = null)
    {
        $this->initVar('todo_id', XOBJ_DTYPE_INT, 0, true);
        $this->initVar('todo_uid', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('todo_subject', XOBJ_DTYPE_TXTBOX, null, true, 255);
        $this->initVar('todo_description', XOBJ_DTYPE_TXTAREA, null, false, null);
        $this->initVar('todo_input_date', XOBJ_DTYPE_INT, time(), false);
        $this->initVar('todo_total_time', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('todo_active', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('todo_lock_id', XOBJ_DTYPE_INT, 0, false);

        if (is_array($id)) {
            $this->assignVars($id);
        }
    }

    /**
     * updateTotalTime calculate the total time
     *
     * @return boolean true if update was successful
    */
    public function updateTotalTime()
    {
        $qb = \Xoops::getInstance()->db()->createXoopsQueryBuilder();
        $qb ->select('SUM(log_work_time)')
            ->fromPrefix('demoxadr_log', '')
            ->where('log_todo_id = :ltid')
            ->setParameter(':ltid', $this->getVar('todo_id'), \PDO::PARAM_INT);

        $result = $qb->execute();

        if (!$result) {
            return false;
        }
        $total = $result->fetchColumn();

        if (false !== $total) {
            $this->setVar('todo_total_time', $total);
        }

        return true;
    }

}

class DemoxadrTodoHandler extends XoopsPersistableObjectHandler
{
    public function __construct(Connection $db)
    {
        parent::__construct($db, 'demoxadr_todo', 'DemoxadrTodo', 'todo_id', 'todo_name');
    }
}
