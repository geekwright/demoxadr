<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\CatalogedPrivilege;
use Xmf\Xadr\ResponseSelector;
use Xmf\Xadr\ValidatorManager;
use Xoops\Core\Kernel\Criteria;

class TodoDetailAction extends Action
{
    /**
     * @var Catalog a catalog object
     */
    protected $catalog = null;

    /**
     * Execute the action.
     *
     * @return one of the defined responses
     */
    public function execute()
    {
        $todo_id = $this->request()->getParameter('todo_id');

        $logHandler = $this->controller()->getHandler('log');
        $criteria = new Criteria('log_todo_id', $todo_id);
        $criteria->setSort('log_start_time');

        $this->request()->attributes()->set('loglist', $logHandler->getAll($criteria));
        $this->request()->attributes()->set('loglist_count', $logHandler->getCount($criteria));

        return new ResponseSelector(Xadr::RESPONSE_SUCCESS);
    }

    public function getDefaultResponse()
    {
        return new ResponseSelector(Xadr::RESPONSE_INDEX);
    }

    /**
     * Retrieve the HTTP request method(s) this action will serve.
     *
     * @since  1.0
     */
    public function getRequestMethods()
    {
        return Xadr::REQUEST_ALL;
    }

    /**
     * Determine if this action requires authentication.
     *
     * @return bool TRUE if this action requires authentication, otherwise FALSE.
     *
     * @since  1.0
     */
    public function isLoginRequired()
    {
        return true;
    }

    /**
     * Retrieve the privilege required to access this action.
     */
    public function getRequiredPrivilege()
    {
        $return=null;

        $todo = $this->request()->attributes()->get('todo');
        if (is_object($todo)) {
            $todo_uid = $todo->getVar('todo_uid');
            if ($todo_uid!=$this->user()->id()) {
                $return = new CatalogedPrivilege('todo_permisions', 'view_others_detail', $this->catalog);
            }
        }

        return $return;
    }

    public function registerValidators(ValidatorManager $validatorManager)
    {
        $form_definition=$this->request()->attributes()->get('_fields');
        $fields=$form_definition['fields'];

        foreach ($fields as $fieldname => $fielddef) {
            $validators = $fielddef['input']['validate'];
            foreach ($validators as $validate) {
                $validatorManager->addValidation($fieldname, $validate['type'], $validate['criteria']);
            }
            if ($fielddef['required']) {
                $validatorManager->setRequired($fieldname, true);
            }
        }
    }

    public function validate()
    {
        $todo = $this->request()->attributes()->get('todo');
        if (!is_object($todo)) {
            $this->request()->setError('tododetail', 'Requested todo item not found.');

            return false;
        }

        return true;
    }

    public function initialize()
    {
        $this->catalog = $this->domain()->getDomain('DemoXadrCatalog');

        $todoHandler = $this->controller()->getHandler('todo');

        $todo_id = $this->request()->getParameter('todo_id');
        $todo = $todoHandler->get($todo_id);
        $this->request()->attributes()->set('todo', $todo);

        $fields=array();

        $fields['todo_id'] = array(
                  'type' => 'integer'
                , 'length' => 10
                , 'default' => 0
                , 'description' => 'Todo Item'
                , 'required' => true
                , 'display' => array(
                      'form' => 'text'
                    , 'transform' => ''
                    )
                , 'input' => array(
                      'form' => 'text'
                    , 'validate' => array(
                              array(
                                  'type'=> 'Clean'
                                , 'criteria' => array(
                                        'type' => 'int'
                                    )
                                )
                            , array(
                                  'type'=> 'Number'
                                , 'criteria' => array(
                                      'trim'        => true
                                    , 'min'         => 1
                                    , 'min_error'   => 'A todo item is required'
                                    )
                                )
                            )
                        )
                    );

        $fielddefs=array('fields'=>$fields);
        $this->request()->attributes()->set('_fields', $fielddefs);

        return true;
    }
}
