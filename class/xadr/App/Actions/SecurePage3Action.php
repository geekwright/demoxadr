<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\Privilege;
use Xmf\Xadr\ResponseSelector;

class SecurePage3Action extends Action
{

    /**
     * This action does not handle execution.
     */
    public function execute()
    {
        return new ResponseSelector(Xadr::RESPONSE_NONE);
    }


    /**
     * Retrieve the default response
     *
     * @return one of the defined responses
     */
    public function getDefaultResponse()
    {
        return new ResponseSelector(Xadr::RESPONSE_SUCCESS);
    }

    /**
     * Verify the permission required to access this action.
     *
     * @return array  our required permissions
     */
    public function getRequiredPrivilege()
    {
        return new Privilege('isAdmin', ''); // special permission name - must have module admin
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
    public function getErrorResponse()
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
