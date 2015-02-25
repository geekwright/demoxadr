<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author          trabis <lusopoemas@gmail.com>
 * @version         $Id: install.inc.php 8065 2011-11-06 02:02:32Z beckmi $
 */

function xoops_module_pre_install_demoxadr($module)
{
    if (!class_exists('\Xmf\Loader')) {
        $module->setErrors('<b>Please install or reactivate XMF module</b>');
        return false;
    }
    return true;
}
