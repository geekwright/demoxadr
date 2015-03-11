<?php

namespace Geekwright\DemoXadr\Blocks\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\ResponseSelector;
use Xoops\Core\Kernel\Criteria;
use Xoops\Core\Kernel\CriteriaCompo;

class TodoBlockAction extends Action
{

    public function execute()
    {
        $todoHandler = $this->controller()->getHandler('todo');
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('todo_uid', $this->user()->id()));
        $criteria->add(new Criteria('todo_active', 1));
        $criteria->setSort('todo_input_date');

        $order = (bool) $this->request()->getParameter(0);
        $criteria->setOrder($order?'DESC':'ASC');
        $limit = (int) $this->request()->getParameter(1);
        $limit = ($limit<0) ? 0 : $limit;
        $criteria->setLimit($limit);

        $this->request()->attributes->set('todolist', $todoHandler->getAll($criteria));
        $this->request()->attributes->set('todolist_count', $todoHandler->getCount($criteria));

        return new ResponseSelector(Xadr::RESPONSE_SUCCESS);
    }

    public function getDefaultResponse()
    {
        return new ResponseSelector(Xadr::RESPONSE_SUCCESS);
    }

    public function getRequestMethods()
    {
        return Xadr::REQUEST_ALL;
    }

    public function getErrorResponse()
    {
        return new ResponseSelector(Xadr::RESPONSE_NONE);
    }
}
