<?php
namespace Geekwright\DemoXadr\App\Filters;

use Xmf\Xadr\FilterList;
use Xmf\Xadr\Controller;

class AppFilterList extends FilterList
{

    /**
     * initialize the FilterList
     *
     * @return void
     */
    protected function initialize()
    {
        /* create filter instances here */
        $this->addFilter($this->controller()->getFilter('XoopsWrap'));
        $this->addFilter($this->controller()->getFilter('Breadcrumb'));
    }
}
