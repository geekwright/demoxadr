<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class SecurePage2ResponderSuccess extends XoopsResponder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $this->renderer()->setTemplate('module:demoxadr|demoxadr_index.tpl');

        $this->renderer()->attributes->set('title', 'Secure Page #2');
        $this->renderer()->attributes->set('body', '<div class="text">You have made it to secure page #2.<br/><br/></div>');

        return $this->renderer();
    }
}
