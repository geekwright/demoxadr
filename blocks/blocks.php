<?php
/**
 * blocks
 *
 * @copyright 213-2014 The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license   GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 * @package   demoxadr
 */

function b_todo_list_show($options)
{
    /**
     * Note: If you are using filters, those will execute, so be careful.
     * The demo block is located in the Blocks unit rather than App so we don't
     * run the DefaultFilterList.
     */

    $attributes=new \Xmf\Xadr\XadrArray(array('dirname' => 'demoxadr'));
    $request=new \Xmf\Xadr\Request($options, $attributes);
    \Xmf\Xadr\XoopsController::getNew($request)->dispatch('Blocks', 'TodoBlock');
    $block = $attributes->getAll();
    //\Xoops::getInstance()->events()->triggerEvent('debug.log', $block);
    //\Xoops::getInstance()->events()->triggerEvent('debug.log', $request);

    return $block;
}

function b_todo_list_edit($options)
{
    $block_form = new Xoops\Form\BlockForm();
    $block_form->addElement(
        new Xoops\Form\RadioYesNo('Date sort', 'options[0]', $options[0], 'Most recent first', 'Oldest first')
    );
    $block_form->addElement(
        new Xoops\Form\Text('Maximum number of entries', 'options[1]', 1, 3, $options[1]),
        true
    );
    return $block_form->render();

}
