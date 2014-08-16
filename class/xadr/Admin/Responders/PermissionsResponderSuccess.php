<?php
namespace Geekwright\DemoXadr\Admin\Responders;

use Xmf\Xadr\XoopsResponder;
use Xmf\Xadr\Lib\PermissionMap;

class PermissionsResponderSuccess extends XoopsResponder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $modAdmin = new \Xoops\Module\Admin();
        $modAdmin->displayNavigation('?action=Permissions');
        $map = $this->config()->get('PermissionMap', array());
        echo PermissionMap::renderPermissionForm($map);

        return $this->renderer();
    }
}
