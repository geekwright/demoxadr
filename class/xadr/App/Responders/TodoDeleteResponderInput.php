<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class TodoDeleteResponderInput extends XoopsResponder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $this->renderer()->setTemplate('module:demoxadr/demoxadr_tododelete.tpl');

        $todo=$this->request()->attributes->get('todo');
        $type='s';
        $line=array();
        foreach (array_keys($todo->vars) as $key) {
            $line[$key]=$todo->getVar($key, $type);
        }
        //$title=$line['todo_subject'];

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

        $line['input_date']=formatTimestamp($line['todo_input_date']);

        $line['uname']=(new \XoopsUser($todo->getVar('todo_uid')))->uname();

        $this->renderer()->attributes->set('todo', $line);

        ob_start();
        xoops_confirm(
            array('todo_id'=>$todo->getVar('todo_id')),
            '',
            '<br />Confirm deletion of this item<br />',
            'Delete',
            $addtoken = true
        );
        $body = ob_get_contents();
        ob_end_clean();

        $this->renderer()->attributes->set('title', 'Confirm Delete');
        $this->renderer()->attributes->set('body', $body);
        //$this->renderer()->attributes->set(
        //    'security_token',
        //    \Xoops::getInstance()->security()->getTokenHTML()
        //);

        $message = $this->request()->attributes->get('message');
        if (!empty($message)) {
            $this->renderer()->attributes->set('message', $message);
        }

        return $this->renderer();
    }
}
