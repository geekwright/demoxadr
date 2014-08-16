<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;

class SecurePage2Action extends Action
{

    /**
     * This action does not handle execution.
     */
    public function execute()
    {
        return Xadr::RESPONSE_NONE;
    }


    /**
     * Retrieve the default response
     *
     * @return one of the defined responses
     */
    public function getDefaultResponse()
    {
        return Xadr::RESPONSE_SUCCESS;
    }

    /**
     * Retrieve the privilege required to access this action.
     *
     * NOTE: NULL can be returned to specify that an action is secure, but does not
     *       require a specific privilege.
     *
     * NOTE: This will only be called if isSecure() returns TRUE.
     *
     * @return an array containing two values. The first is the privilege name.
     *         The second is the namespace in which the privilege resides.
     *         If no privilege is required, NULL is returned.
     */
    public function getPrivilege()
    {
        return array('SecurePage2', 'AuthenticationExample');
    }

    /**
     * There's nothing to execute, so we're going to skip to the responder
     * on any request method.
     */
    public function getRequestMethods()
    {
        return Xadr::REQUEST_NONE;
    }

    /**
     * No errors can occur.
     */
    public function handleError ()
    {
    }

    /**
     * Determine if this action requires the user to be authenticated.
     *
     * @return TRUE, if this action requires authentication, otherwise FALSE.
     */
    public function isSecure()
    {
        return true;
    }
}
