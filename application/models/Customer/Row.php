<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 07.11.16
 * Time: 20:27
 */

namespace Application\Customer;

/**
 * Class Row
 * @package Application\Customer
 *
 * property integer $id
 * @property string $email
 * @property string $created
 */
class Row extends \Bluz\Db\Row
{
    public function beforeInsert()
    {
        $this->created = gmdate('Y-m-d H:i:s');
    }
}