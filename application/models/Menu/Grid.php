<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

/**
 * @namespace
 */
namespace Application\Users;

use Bluz\Db\Query\Select;
use Bluz\Grid\Source\SelectSource;

/**
 * @category Application
 * @package  Users
 */
class Grid extends \Bluz\Grid\Grid
{
    /**
     * @var string
     */
    protected $uid = 'menu';

    /**
     * init
     *
     * @return self
     */
    public function init()
    {
        // Create Select
        $select = new Select();
        $select->select('m.id, d.name as name, d.description as description, d.photo as photo')
            ->from('menu', 'm')
            ->leftJoin('m', 'dishes', 'd', 'm.`dishId` = d.`id`');


        // Setup adapter
        $adapter = new SelectSource();
        $adapter->setSource($select);

        $this->setAdapter($adapter);
        $this->setAllowOrders(['id']);
//        $this->setAllowFilters(['login', 'email', 'status', 'id', 'roleId']);
        return $this;
    }
}
