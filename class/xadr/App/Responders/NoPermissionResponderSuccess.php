<?php
namespace Geekwright\DemoXadr\App\Responders;

use Xmf\Xadr\XoopsResponder;

class NoPermissionResponderSuccess extends XoopsResponder
{

    /**
     * Execute the responder
     *
     * @return a Renderer instance.
     */
    public function execute()
    {
        $this->renderer()->setTemplate('module:demoxadr|demoxadr_index.tpl');

        $priv=$this->user()->lastPrivilegeChecked();

        $this->renderer()->attributes->set('title', 'No Permission');
        $this->renderer()->attributes->set(
            'body',
            '<div class="text">'
            . \XoopsLocale::E_NO_ACCESS_PERMISSION
            . '<br/><br/><span class="text-bold">Name:</span> '
            . $priv[0]
            .'<br/><span class="text-bold">Namespace:</span> '
            . $priv[1]
            .'<br/></div> <button onclick="window.history.go(-1)">Back</button>'
        );

        return $this->renderer();
    }
}
