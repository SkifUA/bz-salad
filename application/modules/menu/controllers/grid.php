<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 07.11.16
 * Time: 17:13
 */
namespace Application;

use Bluz\Controller\Controller;
use Bluz\Proxy\Layout;
use Bluz\Proxy\Request;

/**
 * @privilege Management
 *
 * @return void
 */
return function () {
    /**
     * @var Controller $this
     */
    Layout::setTemplate('dashboard.phtml');
    Layout::breadCrumbs(
        [
            Layout::ahref('Dashboard', ['dashboard', 'index']),
            __('Menu')
        ]
    );

    if (Request::isPost()) {

        $request = Request::getParams();

        unset($request['_controller']);
        unset($request['_module']);
        Menu\Table::getInstance()->updateListByRequest($request);
    }

    $grid = new Menu\Grid();
    $grid->setModule($this->module);
    $grid->setController($this->controller);

    $menu = Menu\Table::getInstance()->getMenu();
    $dishes = Dishes\Table::fetchAll();

    $this->assign('dishes', $dishes);
    $this->assign('menu', $menu);
    $this->assign('grid', $grid);
};