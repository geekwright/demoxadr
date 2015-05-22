<?php
namespace Geekwright\DemoXadr\App\Domain;

use Xmf\Xadr\Xadr;
use Xmf\Xadr\Catalog;
use Xmf\Xadr\Catalog\Permission;
use Xmf\Xadr\Exceptions\InvalidCatalogEntryException;

/**
 * Catalog for demoxadr module
 */
class DemoXadrCatalog extends Catalog
{
    /**
     * initialize the catalog
     *
     * @return bool true if catalog has initialized, otherwise false
     */
    public function initialize()
    {
        // add example form support
        $this->initExampleForm();

        // add permissions
        $this->initPermissions();

        return true;
    }

    private function initPermissions()
    {
        $this->newEntry(
            'Permission',
            'AuthenticationExample',
            'Authentication Demo Permissions',
            'Permissions for demonstration purposes'
        )
            ->addItem(1, 'SecurePage1', 'Access Example One')
            ->addItem(2, 'SecurePage2', 'Access Example Two');

        $this->newEntry(
            'Permission',
            'todo_permisions',
            'ToDo Permissions',
            'Control adding, viewing, editing and deleting todo items for self and others'
        )
            ->addItem(1, 'post_todo', 'Add new todo')
            ->addItem(2, 'view_others_detail', 'View others todo detail')
            ->addItem(3, 'edit_my_todo', 'Edit own todo detail')
            ->addItem(4, 'edit_others_todo', 'Edit others todo detail')
            ->addItem(5, 'delete_my_todo', 'Delete own todo detail')
            ->addItem(6, 'delete_others_todo', 'Delete others todo detail');
    }

    private function initExampleForm()
    {
        $field = $this->newEntry('Field', '');
        $field->variableType()
            ->maxLength()
            ->defaultValue()
            ->enumValues(array())
            ->description()
            ->title()
            ->shortTitle()
            ->cleanerType()
            ->validate($field->newValidator()->string()->notEmpty())
            ->validateDescription()
            ->displayTransform(function ($s) { return $s;})
            ->inputTransform(function ($s) { return $s;})
            ->formClassname('Text')
            ->formAttributes(array('required'=>null, ));
    }
}
