<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xoops\Core\Kernel\Criteria;

class TodoListAction extends Action
{

    public function execute()
    {
        $todoHandler = $this->controller()->getHandler('todo');
        $criteria = new Criteria('todo_uid', $this->user()->id());
        $criteria->setSort('todo_active DESC, todo_input_date');
        $criteria->setOrder('DESC');

        $this->request()->attributes->set('todolist', $todoHandler->getAll($criteria));
        $this->request()->attributes->set('todolist_count', $todoHandler->getCount($criteria));

        return Xadr::RESPONSE_INDEX;
    }

    public function getDefaultResponse()
    {
        return Xadr::RESPONSE_INDEX;
    }

    public function isSecure()
    {
        return true;
    }

    public function getPrivilege()
    {
        return null;
    }

    public function getRequestMethods()
    {
        return Xadr::REQUEST_ALL;
    }

    public function handleError()
    {
        return array('App', 'TodoDetail', Xadr::RESPONSE_ERROR);
    }

    public function validate()
    {
        return true;
    }
}
