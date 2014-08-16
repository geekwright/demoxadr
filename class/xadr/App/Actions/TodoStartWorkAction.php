<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\ValidatorManager;

class TodoStartWorkAction extends Action
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

        if ($todo->getVar('todo_active') && !$todo->getVar('todo_lock_id')) {
            $logHandler = $this->controller()->getHandler('log');
            $log = $logHandler->create();
            $log->setVar('log_id', 0);
            $log->setVar('log_todo_id', $todo->getVar('todo_id'));
            $log->setVar('log_start_time', time());
            if ($logHandler->insert($log)) {
                $todo->setVar('todo_lock_id', $log->getVar('log_id'));
                $todoHandler->insert($todo);
                $this->request()->attributes->set('message', 'Work started.');
            } else {
                $this->request()->setError('TodoStartWork', 'Update failed.');

                return Xadr::RESPONSE_ERROR;
            }
        } else {
            $this->request()->setError('TodoStartWork', 'Todo entry is not eligble for this operation.');

            return Xadr::RESPONSE_ERROR;
        }

        $this->controller()->forward('App', 'TodoDetail');

        return Xadr::RESPONSE_NONE;
    }

    public function getDefaultResponse()
    {
        return array('App', 'TodoList', Xadr::RESPONSE_INDEX);
    }

    /**
     * Retrieve the privilege required to access this action.
     */
    public function getPrivilege()
    {
        $return=null;

        $todo = $this->request()->attributes->get('todo');
        if (is_object($todo)) {
            $todo_uid = $todo->getVar('todo_uid');
            if ($todo_uid!=$this->user()->id()) {
                $return=array('edit_others_todo', 'ToDo');
            }
        }

        return $return;
    }

    /**
     * Retrieve the HTTP request method(s) this action will serve.
     *
     * @since  1.0
     */
    public function getRequestMethods()
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
            $this->request()->setError('TodoFlipStatus', 'Requested todo item not found.');

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
            'type' => 'integer',
            'length' => 10,
            'default' => 0,
            'description' => 'Todo Item',
            'required' => true,
            'display' => array(
                'form' => 'text',
                'transform' => '',
            ),
            'input' => array(
                'form' => 'text',
                'validate' => array(
                    array(
                       'type'=> 'Clean',
                        'criteria' => array(
                            'type' => 'int',
                        ),
                    ),
                    array(
                        'type'=> 'Number',
                        'criteria' => array(
                            'trim'        => true,
                            'min'         => 1,
                            'min_error'   => 'A todo item is required',
                        ),
                    ),
                ),
            ),
        );

        $fielddefs=array('fields'=>$fields);
        $this->request()->attributes->set('_fields', $fielddefs);

        return true;
    }
}
