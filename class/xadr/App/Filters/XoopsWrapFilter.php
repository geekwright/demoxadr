<?php
namespace Geekwright\DemoXadr\App\Filters;

use Xmf\Xadr\Config;
use Xmf\Xadr\Filter;
use Xmf\Xadr\FilterChain;
use Xmf\Template\Breadcrumb;

/**
 * Wrap chain with header() and footer()
 */
class XoopsWrapFilter extends Filter
{

    private $xoops = null;

    /**
     * Add the header()
     *
     * @return void
     */
    public function executePreAction()
    {
        $this->xoops = \Xoops::getInstance();
        $this->xoops->header();
    }

    /**
     * Add the footer
     *
     * @return void
     */
    public function executePostAction()
    {
        $this->xoops->footer();
    }
}
