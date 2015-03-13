<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class TodoListResponderIndex extends XoopsResponder
{
    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {

        $this->renderer()->setTemplate('module:demoxadr/demoxadr_todolist.tpl');
        $this->renderer()->attributes->set('title', 'ToDo List');

        $todolist=$this->request()->attributes()->get('todolist');
        $type='s';
        foreach ($todolist as $todo) {
            $line=array();
            foreach (array_keys($todo->vars) as $key) {
                $line[$key]=$todo->getVar($key, $type);
            }
            // these should be transform filters
            // active status
            $line['status'] = $line['todo_active'] ? 'Active' : 'Inactive';
            // total time in days, hours, and minutes
            $total_time = $line['todo_total_time'];
            $times['day'] = intval($total_time / (3600*24));
            $times['hour'] = intval(($total_time-$times['day']*3600*24)/3600);
            $times['min'] = intval(($total_time-$times['day']*3600*24-$times['hour']*3600)/60);
            $format="%d Day(s) %d:%d";
            $line['total_time']=@sprintf($format, $times['day'], $times['hour'], $times['min']);

            $this->renderer()->attributes->setArrayItem('todo', null, $line);
        }

        $err_message = $this->request()->getErrorsAsHtml();
        if (!empty($err_message)) {
            $this->renderer()->attributes->set('err_message', $err_message);
        }
        $this->renderer()->attributes->set('imagedir', \Xmf\Module\Admin::iconUrl('', '16'));
        $message = $this->request()->attributes()->get('message');
        if (!empty($message)) {
            $this->renderer()->attributes->set('message', $message);
        }

        return $this->renderer();
    }
}
