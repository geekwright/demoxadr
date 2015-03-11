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
    }
}
