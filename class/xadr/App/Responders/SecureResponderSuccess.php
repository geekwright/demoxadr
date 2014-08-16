<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class SecureResponderSuccess extends XoopsResponder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {

        $secure1URL = $this->controller()->getControllerPath('App', 'SecurePage1');
        $secure2URL = $this->controller()->getControllerPath('App', 'SecurePage2');
        $secure3URL = $this->controller()->getControllerPath('App', 'SecurePage3');

        $this->renderer()->setTemplate('module:demoxadr|demoxadr_index.tpl');

        $this->renderer()->attributes->set('title', 'Authentication');
        $body = <<<EOT
            <div class="text">
            <p>This is a privilege example. You must be signed in to see this page.
            If you are not signed in, you will be redirected to the system login page.
            Also, there are two secure pages that both require a group permission
            assigned in module administration.</p>
            <p><a href="{$secure1URL}" class="btn btn-info">Secure Page #1</a>
            Permission "Access Example One" is required to access this page.
            </p>
            <p><a href="{$secure2URL}" class="btn btn-info">Secure Page #2</a>
            Permission "Access Example Two" is required to access this page.
            </p>
            <p><a href="{$secure3URL}" class="btn btn-warning">Secure Page #3</a>
            Module Admin Permission is required to access this page.
            </p>
            </div>
            <br/><br/>
EOT;

        $this->renderer()->attributes->set('body', $body);

        return $this->renderer();

    }
}
