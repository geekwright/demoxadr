<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\ResponseSelector;

class SecureAction extends Action
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
     * There's nothing to execute, so we're going to skip to the responder
     * on any request method.
     */
    public function getRequestMethods()
    {
        return Xadr::REQUEST_NONE;
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
