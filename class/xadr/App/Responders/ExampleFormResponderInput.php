<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class ExampleFormResponderInput extends XoopsResponder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $this->renderer()->setTemplate('module:demoxadr|demoxadr_index.tpl');
        $this->renderer()->attributes->set('title', 'Example Form');
        $form=$this->form()->renderForm('_fields');
        $body='<div>This is an example of various validators that can be applied to user input. Try garbage data (like spaces to defeat the XOOPS form required javascript, or plain old key mashing) and see what happens.</div>';
        $this->renderer()->attributes->set('body', $body.$form);

        return $this->renderer();
    }
}
