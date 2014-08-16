<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\ValidatorManager;
use Xoops\Core\Kernel\Criteria;

class TodoDeleteAction extends Action
{

    /**
     * Execute the action.
     *
     * @return one of the defined responses
     */
    public function execute()
    {

        $todo = $this->request()->attributes->get('todo');
        $todoHandler = $this->request()->attributes->get('todoHandler');

        $logHandler = $this->controller()->getHandler('log');

        // first the logs
        $logstat = $logHandler->deleteAll(new Criteria('log_todo_id', $todo->getVar('todo_id')));

        // next the todo itself
        $todostat = $todoHandler->delete($todo);

        if (false) {
            $this->request()->setError('TodoDelete', 'Delete failed.');

            return Xadr::RESPONSE_ERROR;
        }

        $this->request()->attributes->set('message', 'Todo deleted.');

        $this->controller()->forward('App', 'TodoList');

        return Xadr::RESPONSE_NONE;

    }

    public function getDefaultResponse()
    {
        $todo = $this->request()->attributes->get('todo');
        if (!is_object($todo) || !($todo->getVar('todo_id'))) {
            $this->request()->setError('TodoDelete', 'Todo item not found.');
            $this->controller()->forward('App', 'TodoList');

            return Xadr::RESPONSE_NONE;
        }

        return Xadr::RESPONSE_INPUT;
    }

    /**
     * Retrieve the privilege required to access this action.
     */
    public function getPrivilege()
    {
        $return=array('delete_my_todo', 'ToDo');

        $todo = $this->request()->attributes->get('todo');
        if (is_object($todo)) {
            $todo_uid = $todo->getVar('todo_uid');
            if ($todo_uid!=$this->user()->id()) {
                $return=array('delete_others_todo', 'ToDo');
            }
        }

        return $return;

    }

    public function isSecure()
    {
        return true;
    }

    /**
     * Retrieve the HTTP request method(s) this action will serve.
     *
     * @since  1.0
     */
    public function getRequestMethods ()
    {
        return Xadr::REQUEST_POST;
    }

    public function handleError()
    {
        return Xadr::RESPONSE_ERROR;
    }

    public function registerValidators(ValidatorManager $validatorManager)
    {

        $form_definition=$this->request()->attributes->get('_fields');
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
        $xoops = \Xoops::getInstance();
        if (!$xoops->security()->check()) {
            $msg = implode(',', $xoops->security()->getErrors());
            $this->request()->setError('global:xoopsSecurity', (empty($msg)?'Security check failed':$msg));
            return false;
        }

        $todo = $this->request()->attributes->get('todo');
        if (!is_object($todo)) {
            $this->request()->setError('TodoDelete', 'Requested todo item not found.');

            return false;
        }

        return true;
    }

    public function initialize()
    {

        $todoHandler = $this->controller()->getHandler('todo');

        $todo_id = $this->request()->getParameter('todo_id');
        $todo = $todoHandler->get($todo_id);
        $this->request()->attributes->set('todo', $todo);
        $this->request()->attributes->set('todoHandler', $todoHandler);

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
        $this->request()->attributes->set('_fields', $fielddefs);

        return true;
    }
}
