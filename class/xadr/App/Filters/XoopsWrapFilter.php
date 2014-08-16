<?php
namespace Geekwright\DemoXadr\App\Filters;

use Xmf\Xadr\Config;
use Xmf\Xadr\Filter;
use Xmf\Template\Breadcrumb;

class XoopsWrapFilter extends Filter
{

    /**
     * Wrap chain with header() and footer()
     *
     * @param FilterChain $filterChain the filter chain being processed
     */
    public function execute($filterChain)
    {
        $xoops = \Xoops::getInstance();

        $xoops->header();

        $filterChain->execute();

        $xoops->footer();
    }
}
