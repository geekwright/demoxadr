<?php
namespace Geekwright\DemoXadr\Admin\Responders;

use Xmf\Xadr\Catalog\Entry;
use Xmf\Xadr\XoopsResponder;

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
        $catalog = $this->domain()->getDomain('DemoXadrCatalog', 'App');
        echo $catalog->getEntry(Entry::PERMISSION, 'AuthenticationExample')->renderPermissionForm();
        echo $catalog->getEntry(Entry::PERMISSION, 'todo_permisions')->renderPermissionForm();

        return $this->renderer();
    }
}
