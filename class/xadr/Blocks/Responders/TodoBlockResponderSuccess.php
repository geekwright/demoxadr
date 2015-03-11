<?php

namespace Geekwright\DemoXadr\Blocks\Responders;

use Xmf\Xadr\Responder;

class TodoBlockResponderSuccess extends Responder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $list=array();
        $todolist=$this->request()->attributes->get('todolist');
        $type='s';
        foreach ($todolist as $todo) {
            $line=array();
            $line['todo_id'] = $todo->getVar('todo_id', $type);
            $line['todo_subject'] = $todo->getVar('todo_subject', $type);
            $list[]=$line;
        }
        if (!empty($list)) {
            $this->request()->attributes->set('todo', $list);
            $this->request()->attributes->set('controller', $this->controller()->getControllerPath());
        }
        $renderer = null;  // we don't need a renderer, nothing to render

        return $renderer;
    }
}
