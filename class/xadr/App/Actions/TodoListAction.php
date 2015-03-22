<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\ResponseSelector;
use Xoops\Core\Kernel\Criteria;

class TodoListAction extends Action
{

    public function execute()
    {
        $todoHandler = $this->controller()->getHandler('todo');
        $criteria = new Criteria('todo_uid', $this->user()->id());
        $criteria->setSort('todo_active DESC, todo_input_date');
        $criteria->setOrder('DESC');

        $this->request()->attributes()->set('todolist', $todoHandler->getAll($criteria));
        $this->request()->attributes()->set('todolist_count', $todoHandler->getCount($criteria));

        return new ResponseSelector(Xadr::RESPONSE_INDEX);
    }

    public function validate()
    {
        return true;
    }

    public function getDefaultResponse()
    {
        return new ResponseSelector(Xadr::RESPONSE_INDEX);
    }

    public function isLoginRequired()
    {
        return true;
    }

    public function getRequestMethods()
    {
        return Xadr::REQUEST_ALL;
    }

    public function getErrorResponse()
    {
        return new ResponseSelector(Xadr::RESPONSE_ERROR, 'App', 'TodoDetail');
    }
}
