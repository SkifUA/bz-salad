<?php

use Phinx\Migration\AbstractMigration;

class DisheMehu extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */

    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->query("
               CREATE TABLE `dishes` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `description` text,
              `photo` varchar(255) DEFAULT NULL,
              `price` int(11) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ");
        
        $this->query("
           CREATE TABLE `menu` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `dishId` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ");
        
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('dishes');
        $this->dropTable('menu');
    }
}
