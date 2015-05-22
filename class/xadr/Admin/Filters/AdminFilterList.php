<?php
namespace Geekwright\DemoXadr\Admin\Filters;

use Xmf\Xadr\FilterList;
use Xmf\Xadr\Controller;

class AdminFilterList extends FilterList
{

    /**
     * initialize a FilterList
     *
     * @return void
     */
    protected function initialize()
    {
        $this->addFilter($this->controller()->getFilter('XoopsAdminWrap'));
    }
}
