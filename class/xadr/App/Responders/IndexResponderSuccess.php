<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class IndexResponderSuccess extends XoopsResponder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $this->renderer()->setTemplate('module:demoxadr|demoxadr_index.tpl');
        $this->renderer()->attributes->set('title', 'Index');
        $this->renderer()->attributes->set(
            'body',
            'This page is the result of the default action of the default Xadr unit. '
            . 'It serves as a brief introduction to the set of examples you choose from the menu below.'
            . '<br/><br/>Please select an example:'
        );

        return $this->renderer();
    }
}
