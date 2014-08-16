<?php
namespace Geekwright\DemoXadr\Admin\Filters;

use Xmf\Xadr\Config;
use Xmf\Xadr\Filter;
use Xmf\Template\Breadcrumb;

class XoopsAdminWrapFilter extends Filter
{

    /**
     * Wrap chain with header() and footer()
     *
     * @param FilterChain $filterChain the filter chain being processed
     */
    public function execute($filterChain)
    {
        $xoops = \Xoops::getInstance();

        include_once $xoops->path('include/cp_functions.php');

        $moduleperm_handler = $xoops->getHandlerGroupperm();
        if ($xoops->isUser()) {
            $url_arr = explode('/', strstr($_SERVER['REQUEST_URI'], '/modules/'));
            if (!$xoops->isActiveModule($url_arr[2])) {
                $xoops->redirect($xoops->url('www/'), 1, \XoopsLocale::E_NO_ACCESS_PERMISSION);
            }
            $xoops->module = $xoops->getModuleByDirname($url_arr[2]);
            unset($url_arr);
            if (!$moduleperm_handler->checkRight(
                'module_admin',
                $xoops->module->getVar('mid'),
                $xoops->user->getGroups()
            )) {
                $xoops->redirect($xoops->url('www/'), 1, \XoopsLocale::E_NO_ACCESS_PERMISSION);
            }
        } else {
            $xoops->redirect($xoops->url('www/user.php'), 1, \XoopsLocale::E_NO_ACCESS_PERMISSION);
        }

        // set config values for this module
        if ($xoops->module->getVar('hasconfig') == 1 || $xoops->module->getVar('hascomments') == 1) {
            $xoops->moduleConfig = $xoops->getModuleConfigs();
        }

        // include the default language file for the admin interface
        $xoops->loadLanguage('admin', $xoops->module->getVar('dirname'));
        $xoops->moduleDirname = $xoops->module->getVar('dirname');
        $xoops->isAdminSide = true;

        $xoops->header('module:system|system_dummy.html');

        $filterChain->execute();

        $xoops->footer();
    }
}
