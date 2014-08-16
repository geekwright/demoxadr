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
 * @copyright 213-2014 The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license   GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 */

$adminmenu=array();

$adminmenu[] = array(
    'title' => _MI_DEMOXADR_ADMENU1 ,
    'link'  => 'admin/?action=Index' ,
    'icon'  => 'home.png'
) ;

$adminmenu[] = array(
    'title' => _MI_DEMOXADR_ADMENU2 ,
    'link'  => 'admin/?action=About' ,
    'icon'  => 'about.png'
) ;

$adminmenu[] = array(
    'title' => _MI_DEMOXADR_ADMENU3 ,
    'link'  => 'admin/?action=Permissions' ,
    'icon'  => 'permissions.png'
) ;
