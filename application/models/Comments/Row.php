<?php
/**
 * Created by PhpStorm.
 * User: valeriy
 * Date: 07.11.16
 * Time: 20:31
 */

namespace Application\Comments;

/**
 * Class Row
 * @package Application\Comments
 *
 * property integer $id
 * @property string $comment
 * @property string $created
 */
class Row extends \Bluz\Db\Row
{
    public function beforeInsert()
    {
        $this->created = gmdate('Y-m-d H:i:s');
    }
}