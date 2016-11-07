<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

/**
 * @namespace
 */
namespace Application\Dishes;

use Bluz\Auth\AbstractRow;

/**
 * Auth Row
 *
 * @package  Application\Dishes
 *
 * @property string $created
 * @property string $updated
 *
 */
class Row extends AbstractRow
{
    /**
     * __insert
     *
     * @return void
     */
    public function beforeInsert()
    {
    }

    /**
     * __update
     *
     * @return void
     */
    public function beforeUpdate()
    {
    }
}
