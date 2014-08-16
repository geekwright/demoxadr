<?php
namespace Geekwright\DemoXadr\App\Filters;

use Xmf\Xadr\FilterList;
use Xmf\Xadr\Controller;

class AppFilterList extends FilterList
{

    /**
     * initialize a FilterList
     *
     * @return void
     */
    protected function initialize()
    {
        /* create filter instances here */
        $this->filters['XoopsWrap'] = $this->controller()->getFilter('XoopsWrap');
        $this->filters['Breadcrumb'] = $this->controller()->getFilter('Breadcrumb');
    }
}
