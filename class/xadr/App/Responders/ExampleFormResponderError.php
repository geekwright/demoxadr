<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class ExampleFormResponderError extends XoopsResponder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $this->renderer()->setTemplate('module:demoxadr/demoxadr_index.tpl');
        $this->renderer()->attributes->set('title', 'Example Form');

        $this->renderer()->attributes->set('body', $this->form()->renderForm('_fields'));

        $err_message = $this->request()->getErrorsAsHtml('global:');
        if (!empty($err_message)) {
            $this->renderer()->attributes->set('err_message', $err_message);
        }
        $warning_message =$this->request()->attributes()->get('warning_message');
        if (!empty($warning_message)) {
            $this->renderer()->attributes->set('warning_message', $warning_message);
        }

        return $this->renderer();
    }
}
