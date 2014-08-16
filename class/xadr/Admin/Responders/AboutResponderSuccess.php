<?php
namespace Geekwright\DemoXadr\Admin\Responders;

use Xmf\Xadr\XoopsResponder;

class AboutResponderSuccess extends XoopsResponder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $modAdmin = new \Xoops\Module\Admin();
        $modAdmin->displayNavigation('?action=About');
        $modAdmin->displayAbout();

        return $this->renderer();
    }
}
