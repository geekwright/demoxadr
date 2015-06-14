<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright 2013-2015 XOOPS Project (http://xoops.org)
 * @license   GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 */

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/mainfile.php';

$action = Xmf\Request::getWord('action', 'Index');
Xmf\Xadr\XoopsController::getNew(new Xmf\Xadr\Request(null, array('dirname' => 'demoxadr')))->dispatch('Admin', $action);
