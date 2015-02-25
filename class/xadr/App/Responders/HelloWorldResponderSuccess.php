<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class HelloWorldResponderSuccess extends XoopsResponder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $body = '';

        $this->renderer()->attributes->set('body', '<pre>'.$body.'</pre>');

        $this->renderer()->setTemplate('module:demoxadr/demoxadr_index.tpl');
        $this->renderer()->attributes->set('title', 'Hello, World!');
        $this->renderer()->attributes->set('body', 'Welcome to the "<b>Hello, World!</b>" example. This does nothing but show you the very basics of creating an action.<br/><br/>');

        return $this->renderer();
    }
}
