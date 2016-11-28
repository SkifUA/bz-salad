<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 22.11.16
 * Time: 0:31
 */

namespace Application\Subscribers;


use Application\Exception;
use Application\Privileges;
use Application\Roles;
use Bluz\Auth\AbstractRowEntity;
use Bluz\Auth\AuthException;
use Bluz\Proxy\Auth;
use Bluz\Proxy\Session;
use Bluz\Validator\Traits\Validator;
use Bluz\Validator\Validator as v;
/**
 * Class Subscribers
 * @package Application\Subscribers
 *
 * property integer $id
 * @property string $email
 */
class Row extends \Bluz\Db\Row
{
    use Validator;
    
    public function beforeInsert()
    {
        $this->email = strtolower($this->email);

        $this->addValidator(
            'email',
            v::required()->email(true),
            v::callback(function ($email) {
                $user = $this->getTable()
                    ->select()
                    ->where('email = ?', $email)
                    ->andWhere('id != ?', $this->id)
                    ->execute();
                return !$user;
            })->setError('User with email "{{input}}" already exists')
        );
    }
}