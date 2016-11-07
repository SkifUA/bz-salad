<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 06.11.16
 * Time: 0:22
 */

namespace Application\Dishes;

/**
 * Pages Table
 *
 * @package  Application\Dishes
 *
 * @method   static Row findRow($primaryKey)
 * @method   static Row findRowWhere($whereList)
 */
class Table extends \Bluz\Db\Table
{
    /**
     * Table
     *
     * @var string
     */
    protected $table = 'dishes';


    /**
     * Primary key(s)
     * @var array
     */
    protected $primary = array('id');
}