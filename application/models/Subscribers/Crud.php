<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 22.11.16
 * Time: 0:42
 */

namespace Application\Subscribers;


use Application\Auth;
use Application\UsersActions;



class Crud extends \Bluz\Crud\Table
{
    public function createOne($data)
    {
        

        /** @var $row Row */

        $row->save();

        $userId = $row->id;

        return $userId;
    }

}