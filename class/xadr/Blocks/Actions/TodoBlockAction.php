<?php

namespace Geekwright\DemoXadr\Blocks\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xoops\Core\Kernel\Criteria;

class TodoBlockAction extends Action
{

    public function execute()
    {
        $todoHandler = $this->controller()->getHandler('todo');
        $criteria = new Criteria('todo_uid', $this->user()->id());
        $criteria->setSort('todo_input_date');

        $order = (bool) $this->controller()->getExternalCom()->getParameter(0);
        $criteria->setOrder($order?'DESC':'ASC');
        $limit = (int) $this->controller()->getExternalCom()->getParameter(1);
        $limit = ($limit<0) ? 0 : $limit;
        $criteria->setLimit($limit);

        $this->request()->attributes->set('todolist', $todoHandler->getAll($criteria));
        $this->request()->attributes->set('todolist_count', $todoHandler->getCount($criteria));

        return Xadr::RESPONSE_SUCCESS;
    }

    public function getDefaultResponse ()
    {
        return Xadr::RESPONSE_SUCCESS;
    }

    public function getRequestMethods ()
    {
        return Xadr::REQUEST_ALL;
    }

    public function handleError ()
    {
        return Xadr::RESPONSE_NONE;
    }
}
