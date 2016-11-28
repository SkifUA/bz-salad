<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 22.11.16
 * Time: 0:36
 */

namespace Application;

use Application\Users;
use Bluz\Controller\Controller;
use Bluz\Controller\Mapper\Crud;

return function () {
    /**
     * @var Controller $this
     */
    $crud = new Crud();


    $crud->setCrud(Subscribers\Crud::getInstance());

    $crud->get('system', 'crud/get');
    $crud->post('system', 'crud/post');
    $crud->put('system', 'crud/put');
    $crud->delete('system', 'crud/delete');
//var_dump($crud->run()); exit;
    return $crud->run();
};