<?php
namespace Geekwright\DemoXadr\Admin\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\ResponseSelector;

class AboutAction extends Action
{

    /**
     * This action does not handle execution.
     */
    public function execute()
    {
        return new ResponseSelector(Xadr::RESPONSE_NONE);
    }

    /**
     * Retrieve the default response to be displayed when getRequestMethods() does
     * not return the current method.
     *
     * @return one of the defined responses
     */
    public function getDefaultResponse()
    {
        // our default response is the success response, since no validation or
        // execution will occur.
        return new ResponseSelector(Xadr::RESPONSE_SUCCESS);
    }

    public function getRequestMethods()
    {
        // we want to skip validation and execution and go directly to the
        // responder, so we tell the framework that no request methods are served
        // by this action.
        return Xadr::REQUEST_NONE;
    }
}
