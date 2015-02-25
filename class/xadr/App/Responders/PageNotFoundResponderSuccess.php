<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class PageNotFoundResponderSuccess extends XoopsResponder
{
    public function execute()
    {
        \Xmf\Debug::dump($this->controller());
        $this->renderer()->setTemplate('module:demoxadr/demoxadr_index.tpl');

        $this->renderer()->attributes->set('title', 'Page Not Found');

        $this->renderer()->attributes->set(
            'body',
            'The specified unit or action does not exist.<br/><br/>'
            . '<span class="text-bold">Unit:</span> '
            . $this->controller()->getRequestUnit()
            . '<br/><span class="text-bold">Action:</span> '
            . $this->controller()->getRequestAction()
        );

        return $this->renderer();
    }
}
