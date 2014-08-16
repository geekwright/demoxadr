<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class TodoDeleteResponderError extends XoopsResponder
{

   /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $this->renderer()->setTemplate('module:demoxadr|demoxadr_index.tpl');
        $this->renderer()->attributes->set('title', 'Your request could not be completed.');

        $err_message = $this->request()->getErrorsAsHtml();
        if (!empty($err_message)) {
            $this->renderer()->attributes->set('err_message', $err_message);
        }

        $backUrl = $this->controller()->getControllerPath(null, 'TodoList');

        $body = '<a href="' . $backUrl . '" class="btn btn-info active" role="button">Back</a><br /><br />';
        $this->renderer()->attributes->set('body', $body);

        return $this->renderer();
    }
}
