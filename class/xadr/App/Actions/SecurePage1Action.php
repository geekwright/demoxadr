<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\CatalogedPrivilege;
use Xmf\Xadr\ResponseSelector;

class SecurePage1Action extends Action
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
     * @return Privilege  our required permission
     */
    public function getRequiredPrivilege()
    {
        return new CatalogedPrivilege('AuthenticationExample', 'SecurePage1', $this->catalog);
    }

    /**
     * There's nothing to execute, so we're going to skip to the responder
     * on any request method.
     *
     * @return string
     */
    public function getRequestMethods()
    {
        return Xadr::REQUEST_NONE;
    }

    /**
     * No errors can occur.
     * @return void
     */
    public function getErrorResponse()
    {
    }

    /**
     * Determine if this action requires the user to be authenticated.
     *
     * @return boolean TRUE if this action requires authentication, otherwise FALSE
     */
    public function isSecure()
    {
        return true;
    }

    /**
     * initialize Action, load our Catalog
     */
    public function initialize()
    {
        $this->catalog = $this->domain()->getDomain('DemoXadrCatalog');
        return true;
    }
}
