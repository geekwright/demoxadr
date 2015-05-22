<?php
namespace Geekwright\DemoXadr\App\Actions;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Action;
use Xmf\Xadr\ResponseSelector;
use Xmf\Xadr\ValidatorManager;

class ExampleFormAction extends Action
{

    /**
     * Execute the action.
     *
     * @return one of the defined responses
     */
    public function execute()
    {
        $form_var = $this->request()->getParameter('form_var', '');

        $this->request()->attributes()->set('form_var', $form_var);

        return new ResponseSelector(Xadr::RESPONSE_SUCCESS);

    }

    public function getDefaultResponse()
    {
        return new ResponseSelector(Xadr::RESPONSE_INPUT);
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

    public function getErrorResponse()
    {
        $this->request()->attributes()->set('warning_message', 'Form validation failed. Please correct and resubmit.');
        return new ResponseSelector(Xadr::RESPONSE_ERROR);
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

/*      $criteria  = array(
              'trim'        => true
            , 'max'         => 10
            , 'min'         => 3
//          , 'allowed'     => true
//          , 'chars'       => str_split(   'ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
//                                          'abcdefghijklmnopqrstuvwxyz' .
//                                          '0123456789-_',1)
//          , 'chars_error' => 'Value contains an invalid character'
//          , 'max_error'   => 'Value is too long'
//          , 'min_error'   => 'Value is too short'
            );
//      $validatorManager->addValidation('form_var', 'String', $criteria);

//      $criteria  = array(
//            'lookup_table'  => 'users'
//          , 'lookup_column' => 'uname'
//          );
//      $validatorManager->addValidation('form_var', 'Lookup', $criteria);
        $validatorManager->addValidation('form_var', 'Confirm', 'form_var2');

        $validatorManager->setRequired('form_var', true, 'Name is required.');
*/
    }

    public function validate()
    {
        $xoops = \Xoops::getInstance();
        if (!$xoops->security()->check()) {
            $msg = implode(',', $xoops->security()->getErrors());
            $this->request()->setError('global:xoopsSecurity', (empty($msg)?'Security check failed':$msg));
            return false;
        }

        return true;
    }

    public function initialize()
    {

        $source = array(
              'type' => 'none' // 'row', 'list', 'none'
            );

        $form=array(
            'name' => 'form',
            'title' => 'Example Form',
            'action' => '',
            'method' => 'post',
            'addtoken' => true,
        );

        $fields=array();

        $fields['form_name'] = array(
            'type' => 'string',
            'length' => 40,
            'default' => '',
            'description' => 'Name',
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
                        'criteria' => null,
                    ),
                    array(
                        'type'=> 'String',
                        'criteria' => array(
                            'trim'        => true,
                            'max'         => 40,
                            'min'         => 1,
                        ),
                    ),
                ),
            ),
        );

        $fields['form_email'] = array(
            'type' => 'string',
            'length' => 60,
            'default' => '',
            'description' => 'Email',
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
                        'criteria' => null,
                    ),
                    array(
                        'type'=> 'Email',
                        'criteria' => null,
                    ),
                ),
            ),
        );

        $fields['form_email_confirm'] = array(
            'type' => 'string',
            'length' => 60,
            'default' => '',
            'description' => 'Confirm Email',
            'required' => true,
            'display' => array(
                'form' => 'text',
                'transform' => '',
            ),
            'input' => array(
                'form' => 'text',
                'validate' => array(
                    array(
                        'type'=> 'Confirm',
                        'criteria' => array('confirm' => 'form_email',),
                    ),
                ),
            ),
        );

        $fields['form_phone_number'] = array(
            'type' => 'string',
            'length' => 30,
            'default' => '',
            'description' => 'Phone Number',
            'required' => true,
            'display' => array(
                'form' => 'text',
                'transform' => '',
            ),
            'input' => array(
                'form' => 'text',
                'validate' => array(
                    array(
                        'type'=> 'String',
                        'criteria' => array(
                            'trim'        => true,
                            'min'         => 4,
                            'max'         => 30,
                            'allowed'     => true,
                            'chars'       => str_split('0123456789+()-', 1),
                            'chars_error' => 'Only numbers allowed',
                        ),
                    ),
                ),
            ),
        );

        $fields['form_pin'] = array(
            'type' => 'string',
            'length' => 4,
            'default' => '',
            'description' => 'PIN',
            'required' => true,
            'display' => array(
                'form' => 'password',
                'transform' => '',
            ),
            'input' => array(
                'form' => 'password',
                'validate' => array(
                    array(
                        'type'=> 'String',
                        'criteria' => array(
                            'trim'        => true,
                            'min'         => 4,
                            'max'         => 4,
                            'allowed'     => true,
                            'chars'       => str_split('0123456789', 1),
                            'chars_error' => 'Only numbers allowed',
                        ),
                    ),
                ),
            ),
        );

        $fields['form_years'] = array(
            'type' => 'string',
            'length' => 4,
            'default' => '',
            'description' => 'Years Experience',
            'required' => true,
            'display' => array(
                'form' => 'text',
                'transform' => '',
            ),
            'input' => array(
                'form' => 'text',
                'validate' => array(
                    array(
                        'type'=> 'Number',
                        'criteria' => array(
                            'min'         => 0,
                            'max'         => 99,
                            'strip'       => true,
                        ),
                    ),
                ),
            ),
        );

        $fields['form_comment'] = array(
            'type' => 'string',
            'length' => 500,
            'default' => '',
            'description' => 'Comment',
            'required' => false,
            'display' => array(
                'form' => 'textarea',
                'transform' => '',
            ),
            'input' => array(
                'form' => 'textarea',
                'height' => 4,
                'width' => 40,
                'validate' => array(
                    array(
                        'type'=> 'Clean',
                        'criteria' => 'form_email',
                    ),
                    array(
                        'type'=> 'String',
                        'criteria' => array(
                            'trim'        => true,
                            'max'         => 500,
                        ),
                    ),
                ),
            ),
        );

        $fielddefs=array('form'=>$form, 'fields'=>$fields);
        $this->request()->attributes()->set('_fields', $fielddefs);

        return true;
    }
}
