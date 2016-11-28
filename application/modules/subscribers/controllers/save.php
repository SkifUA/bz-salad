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

return function ($email) {

    if (empty(Subscribers\Table::getInstance()->getRowByEmail($email))) {
        Subscribers\Table::insert(['email' => $email]);
    }
};
