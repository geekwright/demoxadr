<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class SecurePage1ResponderSuccess extends XoopsResponder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $this->renderer()->setTemplate('module:demoxadr|demoxadr_index.tpl');

        $this->renderer()->attributes->set('title', 'Secure Page #1');
        $body=sprintf("Hello, %s. You have made it to secure page #1.", $this->user()->uname());
        $this->renderer()->attributes->set('body', '<div class="text">'.$body.'<br/><br/></div>');

        return $this->renderer();
    }
}
