<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 05.11.16
 * Time: 20:28
 */

namespace Application\Menu;

use Bluz\Db\Query\Select;
use Bluz\Grid\Source\SelectSource;
use Bluz\Proxy\Db;

/**
 * Class Table
 * @package Application\Menu
 *
 * @package Application\Categories
 *
 * @method  static Row findRow($primaryKey)
 * @method  static Row findRowWhere($whereList)
 */

class Table extends \Bluz\Db\Table
{
    /**
     * Table
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * @return array|int|string
     */
    public function getMenu()
    {
        $select = $this->select()
            ->select('m.id as id, d.name as name, d.description as description, d.photo as photo, d.price as price')
            ->from('menu', 'm')
            ->leftJoin('m', 'dishes', 'd', 'm.`dishId` = d.`id`')
            ->groupBy('id')
            ->orderBy('id');

        return $select->execute();
    }
}
