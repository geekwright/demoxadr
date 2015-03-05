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
     * Verify the permission required to access this action.
     *
     * @return array  our required permissions
     */
    public function getPrivilege()
    {
        return array('AuthenticationExample', 'SecurePage2');
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
    public function handleError()
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
