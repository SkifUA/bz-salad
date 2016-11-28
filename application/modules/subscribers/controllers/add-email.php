<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 22.11.16
 * Time: 20:04
 */

namespace Application;

use Application\Subscribers;
use Bluz\Controller;
use Bluz\Proxy\Messages;

return function ($email) {

    if (empty(Subscribers\Table::getInstance()->getRowByEmail($email))) {
        Subscribers\Table::insert(['email' => $email]);
        Messages::addSuccess(__('Вы подписались на нашу рассылку'));
    }
    Messages::addNotice(__('Ваш адрес уже есть в списке рассылки'));
};
