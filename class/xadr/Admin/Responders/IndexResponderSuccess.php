<?php
namespace Geekwright\DemoXadr\Admin\Responders;

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
        $modAdmin = new \Xoops\Module\Admin();
        $modAdmin->displayNavigation('?action=Index');
        $modAdmin->displayIndex();

        return $this->renderer();
    }
}
