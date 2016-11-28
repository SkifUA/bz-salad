<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 28.11.16
 * Time: 23:17
 */

/**
 * @namespace
 */
namespace Application;

use Bluz\Controller;
use Bluz\Proxy\Messages;

return function ($comment) {

    if ($comment != '') {
        $created = gmdate('Y-m-d H:i:s');
        Comments\Table::insert(['comment' => $comment, 'created' => $created]);
        Messages::addSuccess(__('Ваше сообщение отправленно Нашим поворам'));
    }
};