<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class TodoDetailResponderSuccess extends XoopsResponder
{
   /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $this->renderer()->setTemplate('module:demoxadr/demoxadr_tododetail.tpl');

        $todo=$this->request()->attributes()->get('todo');
        $type='s';
        $line=array();
        foreach (array_keys($todo->vars) as $key) {
            $line[$key]=$todo->getVar($key, $type);
        }
        // these should be transform filters
        // capture title
        $title=$line['todo_subject'];
        // active status
        $line['status'] = $line['todo_active'] ? 'Active' : 'Inactive';
        // total time in days, hours, and minutes
        $total_time = $line['todo_total_time'];
        $times['day'] = intval($total_time / (3600*24));
        $times['hour'] = intval(($total_time-$times['day']*3600*24)/3600);
        $times['min'] = intval(($total_time-$times['day']*3600*24-$times['hour']*3600)/60);
        $format="%d Day(s) %d:%d";
        $line['total_time']=@sprintf($format, $times['day'], $times['hour'], $times['min']);
\Xoops::getInstance()->events()->triggerEvent('debug.log', $todo->getVars());
        $this->renderer()->attributes->set('todo', $line);

        $logs=$this->request()->attributes()->get('loglist');
        if (is_array($logs)) {
            $type='s';
            foreach ($logs as $log) {
                $line=array();
                foreach (array_keys($log->vars) as $key) {
                    $line[$key]=$log->getVar($key, $type);
                }
                // these should be transform filters
                // total time in days, hours, and minutes
                $worktime = $line['log_work_time'];
                $times['hour'] = intval($worktime/3600);
                $times['min'] = intval(($worktime-$times['hour']*3600)/60);
                $format="%d:%d";
                $line['work_time']=@sprintf($format, $times['hour'], $times['min']);

                $this->renderer()->attributes->setArrayItem('logs', null, $line);
            }
        }

        $this->renderer()->attributes->set('title', $title);
        $this->renderer()->attributes->set(
            'security_token',
            \Xoops::getInstance()->security()->getTokenHTML()
        );

        $message = $this->request()->attributes()->get('message');
        if (!empty($message)) {
            $this->renderer()->attributes->set('message', $message);
        }

        return $this->renderer();
    }
}
