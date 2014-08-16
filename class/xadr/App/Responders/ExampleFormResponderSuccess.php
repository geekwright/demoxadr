<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class ExampleFormResponderSuccess extends XoopsResponder
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

        $this->renderer()->attributes->set('body', $this->form()->renderForm('_fields'));

        $this->renderer()->attributes->set('message', 'OK');

        return $this->renderer();
    }
}
