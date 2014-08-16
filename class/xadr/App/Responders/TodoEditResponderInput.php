<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class TodoEditResponderInput extends XoopsResponder
{
    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $this->renderer()->setTemplate('module:demoxadr|demoxadr_index.tpl');
        $this->renderer()->attributes->set('title', 'Todo Edit (input)');

        $this->renderer()->attributes->set('body', $this->form()->renderForm('_fields'));

        $err_message = $this->request()->getErrorsAsHtml();
        if (!empty($err_message)) {
            $this->renderer()->attributes->set('err_message', $err_message);
        }

        return $this->renderer();
    }
}
