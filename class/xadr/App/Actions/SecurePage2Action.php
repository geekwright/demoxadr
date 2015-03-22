<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\CatalogedPrivilege;
use Xmf\Xadr\ResponseSelector;

class SecurePage2Action extends Action
{
    /**
     * @var Catalog a catalog object
     */
    protected $catalog = null;

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
        return new CatalogedPrivilege('AuthenticationExample', 'SecurePage2', $this->catalog);
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
    public function isLoginRequired()
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
