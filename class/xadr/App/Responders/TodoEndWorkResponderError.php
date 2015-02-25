<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class TodoEndWorkResponderError extends XoopsResponder
{
   /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {

        $this->renderer()->setTemplate('module:demoxadr/demoxadr_index.tpl');
        $this->renderer()->attributes->set('title', 'Your request could not be completed.');

        $err_message = $this->request()->getErrorsAsHtml();
        if (!empty($err_message)) {
            $this->renderer()->attributes->set('err_message', $err_message);
        }

        $todo_id = $this->request()->getParameter('todo_id');
        $backUrl = $this->controller()->getControllerPathWithParams(null, 'TodoDetail', array('todo_id' => $todo_id));

        $body = '<a href="' . $backUrl . '" class="btn btn-info active" role="button">Back</a><br /><br />';
        $this->renderer()->attributes->set('body', $body);

        return $this->renderer();
    }
}
