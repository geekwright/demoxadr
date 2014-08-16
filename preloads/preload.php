<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

use Xoops\Core\PreloadItem;
use Xoops\Core\Psr4ClassLoader;

/**
 * Demoxadr preloads
 *
 * @category  preloads
 * @package   DemoxadrPreload
 * @author    Richard Griffith <richard@geekwright.com>
 * @copyright 2014 The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license   GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @link      http://xoops.org
 * @since     2.6.0
 */
class DemoxadrPreload extends PreloadItem
{
    /**
     * listen for core.include.common.psr4loader event
     *
     * @param Psr4ClassLoader $autoloader - PSR4 autoloader
     *
     * @return void
     */
    public static function eventCoreIncludeCommonPsr4loader(Psr4ClassLoader $autoloader)
    {
        if (is_a($autoloader, '\Xoops\Core\Psr4ClassLoader')) {
            $path = dirname(dirname(__FILE__)) . '/class/xadr/';
            $autoloader->addNamespace('Geekwright\\DemoXadr', $path);
        }
    }
}
