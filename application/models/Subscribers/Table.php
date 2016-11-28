<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 22.11.16
 * Time: 0:34
 */

namespace Application\Subscribers;

/**
 * Class Table
 *
 * @package Application\Subscribers
 *
 * @method  static Row findRow($primaryKey)
 * @method  static Row findRowWhere($whereList)
 */
class Table extends \Bluz\Db\Table
{
    public function getRowByEmail($email)
    {
        $select = $this->select()
            ->where('email = ?', $email);
        
        return $select->execute();
    }
}