<?php
/**
 * Default module/controller
 *
 * @author   Anton Shevchuk
 * @created  06.07.11 18:39
 */

/**
 * @namespace
 */
namespace Application;

use Bluz\Controller\Controller;
use Application\Menu;


/**
 * @return void
 */
return function ()  {
    /**
     * @var Controller $this
     */

    $menuTable = Menu\Table::getInstance();
    $menu = $menuTable->getMenu();

    $this->assign('menu', $menu);
};
