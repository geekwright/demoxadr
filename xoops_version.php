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
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author          Richard Griffith <richard@geekwright.com>
 */

$modversion['dirname'] = basename(__DIR__);
$modversion['name'] = 'DemoXADR';
$modversion['version'] = '0.1';
$modversion['description'] = 'Demo of XADR, XMF Action Domain Responder capabilities.'
    .' The XADR component and this demo are undergoing continuious refinement and enhancement.';
$modversion['author'] = "Richard Griffith";
$modversion['credits'] = "trabis(www.xuups.com)";
$modversion['help'] = 'page=help';
$modversion['license'] = "GNU GPL 2.0 or later";
$modversion['license_url'] = "http://www.gnu.org/licenses/gpl-2.0.html";
$modversion['official'] = 0;
$modversion['image'] = "icons/logo.png";

$modversion['hasMain'] = 1;

//$modversion['onInstall'] = "include/install.php";
//$modversion['onUpdate'] = "include/update.php";

$modversion['xadr_namespace'] = 'Geekwright\DemoXadr';

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu']  = "admin/menu.php";

$modversion['config'][] = array(
    'name' => 'config1',
    'title' => '_MI_DEMOXADR_CONFIG1',
    'description' => '_MI_DEMOXADR_CONFIG2_DSC',
    'formtype' => 'textbox',
    'valuetype' => 'text',
    'default' => 'this is my test config1 value',
);

$modversion['config'][] = array(
    'name' => 'config2',
    'title' => '_MI_DEMOXADR_CONFIG2',
    'description' => '_MI_DEMOXADR_CONFIG2_DSC',
    'formtype' => 'textbox',
    'valuetype' => 'text',
    'default' => 'this is my test config2 value',
);

// About stuff
$modversion['module_status'] = "Alpha";
$modversion['status'] = "Alpha";
$modversion['release_date'] = "07/18/2013";

$modversion['developer_lead'] = "Richard Griffith";
$modversion['developer_website_url'] = "http://geekwright.com";
$modversion['developer_website_name'] = "geekwright";
$modversion['developer_email'] = "richard@geekwright.com";

// paypal
$modversion['paypal'] = array(
    'business'      => 'xoopsfoundation@gmail.com',
    'item_name'     => $modversion['name'],
    'amount'        => 0,
    'currency_code' => 'USD',
);


$modversion['min_php']             = '5.3.7';
$modversion['min_xoops']           = "2.6.0";

// Mysql file
$modversion['schema'] = 'sql/schema.yml';
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
// Tables
$modversion['tables'] = array(
    'demoxadr_todo',
    'demoxadr_log',
);

// Templates
$pat=dirname(__FILE__).'/templates/'.$modversion['dirname'].'_*.tpl';
foreach (glob($pat) as $filename) {
    $modversion['templates'][] = array(
        'file' => basename($filename),
        'description' => basename($filename));
}

// Blocks
$modversion['blocks'][] = array(
    'file' => 'blocks.php',
    'name' => 'My Todo Items',
    'description' => 'List of a user\'s todo items.',
    'show_func' => 'b_todo_list_show',
    'edit_func' => 'b_todo_list_edit',
    'options' => '0|10',
    'template' => 'demoxadr_block.tpl',
);
