<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\ValidatorManager;

class TodoEditAction extends Action
{

    /**
     * Execute the action.
     *
     * @return one of the defined responses
     */
    public function execute()
    {

        $todo_id = $this->request()->getParameter('todo_id');
        $todo = $this->request()->attributes->get('todo');
        $todoHandler = $this->request()->attributes->get('todohandler');
        if (!is_object($todo) || $todo_id==0) {
                $todo = $todoHandler->create();
                $todo->setVar('todo_id', 0);
                $todo->setVar('todo_uid', $this->user()->id());
                $todo->setVar('todo_input_date', time());
                $todo->setVar('todo_total_time', 0);
                $todo->setVar('todo_lock_id', 0);
        }

        $fieldmaps = $this->request()->attributes->get('_fields');
        $fields = $fieldmaps['update'];

        foreach ($fields as $fieldname) {
            $todo->setVar($fieldname, $this->request()->getParameter($fieldname));
        }

        $todoHandler->insert($todo);

        $this->request()->attributes->set('message', 'Todo item saved.');

        $this->controller()->forward('App', 'TodoList');

        return Xadr::RESPONSE_NONE;
    }

    public function getDefaultResponse()
    {

        $todo = $this->request()->attributes->get('todo');
        $form_definition=$this->request()->attributes->get('_fields');
        $fields=$form_definition['fields'];
        foreach ($fields as $fieldname => $fielddef) {
            $value=null;
            if (is_object($todo)) {
                $value = $todo->getVar($fieldname, 'e');
            }
            if ($value==null) {
                $value = $this->request()->getParameter($fieldname);
            }
            if ($value==null) {
                $value = $this->request()->attributes->get($fieldname);
            }
            if ($value==null) {
                $value = $fielddef['default'];
            }
            $this->request()->attributes->set($fieldname, $value);
        }

        return Xadr::RESPONSE_INPUT;

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

    /**
     * Determine if this action requires authentication.
     *
     * @return bool TRUE if this action requires authentication, otherwise FALSE.
     *
     * @since  1.0
     */
    public function isSecure()
    {
        return true;
    }

    /**
     * Retrieve the privilege required to access this action.
     */
    public function getPrivilege()
    {
        $return = array('post_todo', 'ToDo');

        $todo = $this->request()->attributes->get('todo');
        if (is_object($todo) && $todo->getVar('todo_uid', 'E')) {
            $return = array('edit_my_todo', 'ToDo');
            $todo_uid = $todo->getVar('todo_uid', 'E');
            if ($todo_uid!=$this->user()->id()) {
                $return=array('edit_others_todo', 'ToDo');
            }
        }

        return $return;
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
        $todo = $this->request()->attributes->get('todo');
        if (is_null($todo)) {
            $this->request()->setError('tododedit-validate', 'Requested todo item not found.');

            return false;
        }

        return true;
    }

    public function initialize()
    {
        $source = array(
            'type' => 'row', // 'row', 'list', 'none'
            'handlername' => 'todo',
            'criteria' => 'todo_id', // can be array
            'order' => '',
        );

        $form=array(
            'name' => 'form',
            'title' => 'Edit Todo Item',
            'action' => '',
            'method' => 'post',
            'addtoken' => true,
        );

        // fields to include in update
        $update = array('todo_subject', 'todo_description', 'todo_active');

        $fields=array();

        $fields['todo_id'] = array(
            'type' => 'integer',
            'length' => 10,
            'default' => 0,
            'description' => 'Todo Item',
            'required' => false,
            'display' => array(
                'form' => 'text',
                'transform' => '',
            ),
            'input' => array(
                'form' => 'hidden',
                'validate' => array(
                    array(
                        'type'=> 'Clean',
                        'criteria' => array(
                            'type' => 'int'
                        ),
                    ),
                ),
            ),
        );

        $fields['todo_subject'] = array(
            'type' => 'string',
            'length' => 255,
            'default' => '',
            'description' => 'Subject',
            'required' => true,
            'display' => array(
                'form' => 'text',
                'transform' => '',
            ),
            'input' => array(
                'form' => 'text',
                'validate' => array(
/*                  array(
                       'type'=> 'Clean'
                        'criteria' => null
                    ),
*/                  array(
                        'type'=> 'String',
                        'criteria' => array(
                            'trim'        => true,
                            'max'         => 255,
                            'min'         => 1,
                        ),
                    ),
               ),
            ),
        );

        $fields['todo_description'] = array(
            'type' => 'string',
            'length' => 5000,
            'default' => '',
            'description' => 'Description',
            'required' => false,
            'display' => array(
                'form' => 'text',
                'transform' => '',
            ),
            'input' => array(
                'form' => 'editor',
                'height' => 6,
                'width' => 50,
                'validate' => array(
                    array(
                        'type'=> 'Clean',
                        'criteria' => null,
                    ),
                    array(
                        'type'=> 'String',
                        'criteria' => array(
                            'trim'        => true,
                            'max'         => 5000,
                        ),
                    ),
                ),
            ),
        );

        $fields['todo_active'] = array(
            'type' => 'string',
            'length' => 60,
            'default' => '1',
            'description' => 'Status',
            'required' => true,
            'display' => array(
                'form' => 'text',
                'transform' => '',
            ),
            'input' => array(
                'form' => 'select',
                'options' => array( '0' => 'Inactive', '1' => 'Active'),
                'validate' => array(
                    array(
                        'type'=> 'Choice',
                        'criteria' => array(
                            'choices' => array( '0', '1'),
                        ),
                    ),
                ),
            ),
        );

        $fielddefs=array('source'=>$source, 'form'=>$form, 'fields'=>$fields, 'update'=>$update);

        //$source = array(
        //    'type' => 'row', // 'row', 'list', 'none'
        //    'handlername' => 'todo',
        //    'criteria' => 'todo_id', // can be array
        //    'order' => '',
        //);

        if ($source['type']=='row') {
            $handler = $this->controller()->getHandler($source['handlername']);
            $object = null;
            if ($this->request()->hasParameter($source['criteria'])) {
                $id = (int) $this->request()->getParameter($source['criteria']);
                $object = $handler->get($id);
                if (is_null($object)) {
                    $this->request()->setError('todoedit-initialize', 'Todo item not found');
                    $this->request()->setParameter($source['criteria'], 0);
                //    return false;
                }
            }

            $this->request()->attributes->set($source['handlername'], $object);
            $this->request()->attributes->set($source['handlername'].'handler', $handler);
        }

        $this->request()->attributes->set('_fields', $fielddefs);

        return true;
    }
}
