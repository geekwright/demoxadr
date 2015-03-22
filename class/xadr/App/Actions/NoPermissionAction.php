<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\ResponseSelector;

class NoPermissionAction extends Action
{
    /**
     * This action does not handle execution.
     */
    public function execute()
    {
        return new ResponseSelector(Xadr::RESPONSE_NONE);
    }

    public function validate()
    {
        return true;
    }

    /**
     * Retrieve the default response to be displayed when getRequestMethods() does
     * not return the current method.
     *
     * @return one of the defined responses
     */
    public function getDefaultResponse()
    {
        // our default response is success, since no validation or
        // execution will occur.
        return new ResponseSelector(Xadr::RESPONSE_SUCCESS);
    }

    /**
     * Retrieve all request methods this action will handle.
     *
     * NOTE: When a request is made for this action with a different request method
     *       than provided here, the response is determined by getDefaultResponse().
     *
     * @return one of the defined request methods, or multiple.
     */
    public function getRequestMethods()
    {
        // we want to skip validation and execution and go directly to the
        // responder, so we tell the framework that no request methods are served
        // by this action.
        return Xadr::REQUEST_NONE;
    }
}
