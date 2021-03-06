<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 08.12.16
 * Time: 16:09
 */

namespace Application;

use Bluz\Controller\Controller;
use Bluz\Proxy\Layout;

/**
 * @privilege Management
 * @return \closure
 */
return function () {
    /**
     * @var Controller $this
     */
    Layout::setTemplate('dashboard.phtml');
    Layout::breadCrumbs(
        [
            Layout::ahref('Dashboard', ['dashboard', 'index']),
            __('Users')
        ]
    );

    $grid = new Comments\Grid();
    $grid->setModule($this->module);
    $grid->setController($this->controller);

    $this->assign('grid', $grid);
};