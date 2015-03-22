<?php
namespace Geekwright\DemoXadr\App\Filters;

use Xmf\Xadr\Config;
use Xmf\Xadr\Filter;
use Xmf\Xadr\FilterChain;
use Xmf\Template\Breadcrumb;

/**
 * Build a simple breadcrumb array
 *
 * Normally, this array would be a natural pull from the application, but this is a collection
 * of various demos so it isn't very elegant.
 *
 * The important part is we can take some actions for every page using a filter, including
 * assigning Smarty variables.
 */
class BreadcrumbFilter extends Filter
{

    /**
     * Add breadcrumbs for our global template
     *
     * @param FilterChain $filterChain the filter chain being processed
     *
     * @return void
     */
    public function execute(FilterChain $filterChain)
    {

        $xoopsTpl = \Xoops::getInstance()->tpl();

        $bcitems=array();
        $cur=$this->controller()->getRequestAction();
        if ($cur==$this->config()->get('DEFAULT_ACTION')) {
            $bcitems[]=array('caption'=>'Home');
        } else {
            $bcitems[]=array(
                'caption'=>'Home',
                'link'=> $this->controller()->getControllerPath(
                    $this->config()->get('DEFAULT_UNIT'),
                    $this->config()->get('DEFAULT_ACTION')
                )
            );
            switch ($cur) {
                case 'HelloWorld':
                    $bcitems[]=array('caption'=>'Hello World');
                    break;
                case 'Secure':
                    $bcitems[]=array('caption'=>'Secure Menu');
                    break;
                case 'SecurePage1':
                case 'SecurePage2':
                case 'SecurePage3':
                    $bcitems[]=array(
                        'caption'=>'Secure Menu',
                        'link'=> $this->controller()->getControllerPath('App', 'Secure')
                    );
                    $bcitems[]=array('caption'=>'Secure Page');
                    break;
                case 'ExampleForm':
                    $bcitems[]=array('caption'=>'Example Form');
                    break;
                case 'TodoList':
                    $bcitems[]=array('caption'=>'Todo List');
                    break;
                case 'TodoDetail':
                case 'TodoFlipStatus':
                case 'TodoStartWork':
                case 'TodoEndWork':
                    $bcitems[]=array(
                        'caption'=>'Todo List',
                        'link'=> $this->controller()->getControllerPath('App', 'TodoList')
                    );
                    $bcitems[]=array('caption'=>'Todo Detail');
                    break;
                case 'TodoEdit':
                    $bcitems[]=array(
                        'caption'=>'Todo List',
                        'link'=> $this->controller()->getControllerPath('App', 'TodoList')
                    );
                    $bcitems[]=array('caption'=>'Todo Edit');
                    break;
                case 'TodoDelete':
                    $bcitems[]=array(
                        'caption'=>'Todo List',
                        'link'=> $this->controller()->getControllerPath('App', 'TodoList')
                    );
                    $bcitems[]=array('caption'=>'Todo Delete');
                    break;
                default:
                    $bcitems[]=array('caption'=>'Error');
                    break;
            }
        }
        $breadcrumb = new Breadcrumb();
        $breadcrumb->setItems($bcitems);
        $xoopsTpl->assign('xp_breadcrumb', $breadcrumb->fetch());

        // these are used in menus in module:demoxadr/demoxadr_footer.tpl
        $xoopsTpl->assign('unit_accessor', $this->config()->get('UNIT_ACCESSOR', 'unit'));
        $xoopsTpl->assign('action_accessor', $this->config()->get('ACTION_ACCESSOR', 'action'));

        $filterChain->execute();
    }
}
