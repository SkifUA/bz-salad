<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

/**
 * @namespace
 */
namespace Application\Dishes;

use Bluz\Grid\Source\SqlSource;

/**
 * Grid of Pages
 *
 * @package  Application\Pages
 */
class Grid extends \Bluz\Grid\Grid
{
    /**
     * @var string
     */
    protected $uid = 'dishes';

    /**
     * init
     *
     * @return self
     */
    public function init()
    {
         // Setup source
         $adapter = new SqlSource();
         $adapter->setSource('SELECT * FROM dishes');

         $this->setAdapter($adapter);
         $this->setDefaultLimit(25);
         $this->setAllowOrders(['name', 'id']);
//         $this->setAllowFilters(['title', 'alias', 'description', 'content', 'id']);
         return $this;
    }
}
