<?php

namespace Geekwright\DemoXadr;

use Xmf\Xadr\Lib\Permission;
use Xmf\Xadr\Lib\PermissionMap;

class Configuration extends \Xmf\Xadr\ConfigurationAbstract
{
    protected function initialize()
    {
        /** An absolute file system path to the mvc application directory. */
        //$this->config()->set('UNITS_DIR', __DIR__);

        /** URL to our front controller  */
        $this->config()->set(
            'SCRIPT_PATH',
            \Xoops::getInstance()->url('modules/demoxadr/index.php')
        );

        /** The parameter names used to specify a unit and an action. */
        $this->config()->set('UNIT_ACCESSOR', 'unit');
        $this->config()->set('ACTION_ACCESSOR', 'action');

        /** The unit and action to be used if values are not specified  */
        $this->config()->set('DEFAULT_UNIT', 'App');
        $this->config()->set('DEFAULT_ACTION', 'Index');

        /** The unit and action to be executed when requested action does not exist */
        $this->config()->set('ERROR_404_UNIT', 'App');
        $this->config()->set('ERROR_404_ACTION', 'PageNotFound');

        /** The unit and action to be executed when user does not have
         *  the privilege required for the requested action.
         */
        $this->config()->set('SECURE_UNIT', 'App');
        $this->config()->set('SECURE_ACTION', 'NoPermission');

        $pm = new PermissionMap;
        Permission::initNamespace(
            'AuthenticationExample',
            '_AM_DEMOXADR_PERMISSION_FORM_TITLE',
            '_AM_DEMOXADR_PERMISSION_FORM_DESC'
        )
            ->addItem(1, 'SecurePage1', '_AM_DEMOXADR_PERMISSION_ONE')
            ->addItem(2, 'SecurePage2', '_AM_DEMOXADR_PERMISSION_TWO')
            ->addToMap($pm);
        Permission::initNamespace(
            'todo_permisions',
            '_AM_DEMOXADR_TODO_PERMISSION_FORM_TITLE',
            '_AM_DEMOXADR_TODO_PERMISSION_FORM_DESC'
        )
            ->addItem(1, 'post_todo', '_AM_DEMOXADR_TODO_PERM_POST_TODO')
            ->addItem(2, 'view_others_detail', '_AM_DEMOXADR_TODO_PERM_VIEW_OTHERS_DETAIL')
            ->addItem(3, 'edit_my_todo', '_AM_DEMOXADR_TODO_PERM_EDIT_MY_TODO')
            ->addItem(4, 'edit_others_todo', '_AM_DEMOXADR_TODO_PERM_EDIT_OTHERS_TODO')
            ->addItem(5, 'delete_my_todo', '_AM_DEMOXADR_TODO_PERM_DELETE_MY_TODO')
            ->addItem(6, 'delete_others_todo', '_AM_DEMOXADR_TODO_PERM_DELETE_OTHERS_TODO')
            ->addToMap($pm);

        $this->config()->set('PermissionMap', $pm->getMap());
    }
}
