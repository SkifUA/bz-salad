<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 08.12.16
 * Time: 16:08
 */

namespace Application\Comments;

use Bluz\Grid\Source\SqlSource;

class Grid extends \Bluz\Grid\Grid
{
    /**
     * @var string
     */
    protected $uid = 'comments';

    /**
     * init
     *
     * @return self
     */
    public function init()
    {
        // Setup source
        $adapter = new SqlSource();
        $adapter->setSource('SELECT * FROM comments');

        $this->setAdapter($adapter);
        $this->setDefaultLimit(25);
        $this->setAllowOrders(['name', 'id']);

        return $this;
    }
}
