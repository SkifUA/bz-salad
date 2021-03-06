<?php

use Phinx\Migration\AbstractMigration;

class Init extends AbstractMigration
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
            CREATE TABLE acl_privileges
            (
              roleId INT UNSIGNED NOT NULL,
              module VARCHAR(32) NOT NULL,
              privilege VARCHAR(32) NOT NULL
            );
        ");

        $this->query("
            CREATE TABLE acl_roles
            (
              id INT UNSIGNED NOT NULL AUTO_INCREMENT,
              name VARCHAR(255) NOT NULL,
              created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
              PRIMARY KEY ( id, name )
            );
        ");

        $this->query("
            CREATE TABLE acl_users_roles
            (
              userId BIGINT UNSIGNED NOT NULL,
              roleId INT UNSIGNED NOT NULL,
              PRIMARY KEY ( userId, roleId )
            );
        ");

        $this->query("
            CREATE TABLE auth
            (
              userId BIGINT UNSIGNED NOT NULL,
              provider VARCHAR(64) NOT NULL,
              foreignKey VARCHAR(255) NOT NULL,
              token VARCHAR(64) NOT NULL,
              tokenSecret VARCHAR(64) NOT NULL,
              tokenType CHAR(8) NOT NULL,
              created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
              updated TIMESTAMP NULL,
              expired TIMESTAMP NULL,
              PRIMARY KEY ( userId, provider )
            );
        ");

        $this->query("
            CREATE TABLE categories
            (
              id BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
              parentId BIGINT UNSIGNED,
              name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
              alias VARCHAR(255) NOT NULL,
              created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
              updated TIMESTAMP NULL,
              `order` BIGINT UNSIGNED DEFAULT 0 NOT NULL
            );
        ");

        $this->query("
            CREATE TABLE com_content
            (
              id BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
              settingsId INT UNSIGNED NOT NULL,
              foreignKey INT UNSIGNED NOT NULL,
              userId BIGINT UNSIGNED NOT NULL,
              parentId BIGINT UNSIGNED,
              content LONGTEXT,
              created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
              updated TIMESTAMP NULL,
              status CHAR(7) DEFAULT 'active' NOT NULL
            );
        ");

        $this->query("
            CREATE TABLE com_settings
            (
              id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
              alias VARCHAR(255) NOT NULL,
              options LONGTEXT,
              created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
              updated TIMESTAMP NULL,
              countPerPage SMALLINT DEFAULT 10 NOT NULL,
              relatedTable VARCHAR(64)
            );
        ");

        $this->query("
            CREATE TABLE media
            (
              id BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
              userId BIGINT UNSIGNED NOT NULL,
              module VARCHAR(24) DEFAULT 'users' NOT NULL,
              title LONGTEXT,
              type VARCHAR(24),
              file VARCHAR(255),
              preview VARCHAR(255),
              created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
              updated TIMESTAMP NULL 
            );
        ");

        $this->query("
            CREATE TABLE options
            (
              namespace VARCHAR(64) DEFAULT 'default' NOT NULL,
              `key` VARCHAR(255) NOT NULL,
              value LONGTEXT NOT NULL,
              description LONGTEXT,
              created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
              updated TIMESTAMP NULL,
              PRIMARY KEY ( `key`, namespace )
            );
        ");

        $this->query("
            CREATE TABLE pages
            (
              id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
              title LONGTEXT NOT NULL,
              alias VARCHAR(255) NOT NULL,
              content LONGTEXT,
              keywords LONGTEXT,
              description LONGTEXT,
              created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
              updated TIMESTAMP NULL,
              userId BIGINT UNSIGNED
            );
        ");

        $this->query("
            CREATE TABLE users
            (
              id BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
              login VARCHAR(255),
              email VARCHAR(255),
              created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
              updated TIMESTAMP NULL,
              status CHAR(8) DEFAULT 'disabled' NOT NULL
            );
        ");

        $this->query("
            CREATE TABLE users_actions
            (
              userId BIGINT UNSIGNED NOT NULL,
              code VARCHAR(32) NOT NULL,
              action CHAR(11) NOT NULL,
              params LONGTEXT,
              created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
              expired TIMESTAMP NULL,
              PRIMARY KEY ( userId, code )
            );
        ");

        $this->query("
            ALTER TABLE acl_privileges ADD FOREIGN KEY ( roleId ) REFERENCES acl_roles ( id ) ON DELETE CASCADE ON UPDATE CASCADE;
            CREATE UNIQUE INDEX UNIQUE_access ON acl_privileges ( roleId, module, privilege );
            CREATE INDEX FK_roles ON acl_privileges ( roleId );
            CREATE UNIQUE INDEX UNIQUE_role ON acl_roles ( name );
            ALTER TABLE acl_users_roles ADD FOREIGN KEY ( roleId ) REFERENCES acl_roles ( id ) ON DELETE CASCADE ON UPDATE CASCADE;
            ALTER TABLE acl_users_roles ADD FOREIGN KEY ( userId ) REFERENCES users ( id ) ON DELETE CASCADE ON UPDATE CASCADE;
            CREATE INDEX FK_users ON acl_users_roles ( userId );
            CREATE INDEX FK_roles ON acl_users_roles ( roleId );
            ALTER TABLE auth ADD FOREIGN KEY ( userId ) REFERENCES users ( id ) ON DELETE CASCADE ON UPDATE CASCADE;
            CREATE INDEX FK_users ON auth ( userId );
            ALTER TABLE categories ADD FOREIGN KEY ( parentId ) REFERENCES categories ( id ) ON DELETE CASCADE ON UPDATE CASCADE;
            CREATE UNIQUE INDEX UNIQUE_alias ON categories ( parentId, alias );
            CREATE INDEX FK_parentId ON categories ( parentId );
            ALTER TABLE com_content ADD FOREIGN KEY ( parentId ) REFERENCES com_content ( id ) ON DELETE CASCADE ON UPDATE CASCADE;
            ALTER TABLE com_content ADD FOREIGN KEY ( settingsId ) REFERENCES com_settings ( id ) ON DELETE CASCADE ON UPDATE CASCADE;
            ALTER TABLE com_content ADD FOREIGN KEY ( userId ) REFERENCES users ( id ) ON DELETE CASCADE ON UPDATE CASCADE;
            CREATE INDEX comments_target ON com_content ( settingsId, foreignKey );
            CREATE INDEX FK_users ON com_content ( userId );
            CREATE INDEX FK_parentId ON com_content ( parentId );
            CREATE UNIQUE INDEX UNIQUE_alias ON com_settings ( alias );
            ALTER TABLE media ADD FOREIGN KEY ( userId ) REFERENCES users ( id ) ON DELETE CASCADE ON UPDATE CASCADE;
            CREATE INDEX FK_users ON media ( userId );
            ALTER TABLE pages ADD FOREIGN KEY ( userId ) REFERENCES users ( id ) ON DELETE CASCADE ON UPDATE CASCADE;
            CREATE UNIQUE INDEX UNIQUE_alias ON pages ( alias );
            CREATE INDEX FK_users ON pages ( userId );
            CREATE UNIQUE INDEX UNIQUE_login ON users ( login );
            ALTER TABLE users_actions ADD FOREIGN KEY ( userId ) REFERENCES users ( id ) ON DELETE CASCADE ON UPDATE CASCADE;
            CREATE UNIQUE INDEX UNIQUE_action ON users_actions ( userId, action );
            CREATE INDEX FK_users ON users_actions ( userId );
        ");

    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('users_actions');
        $this->dropTable('pages');
        $this->dropTable('options');
        $this->dropTable('media');
        $this->dropTable('com_content');
        $this->dropTable('com_settings');
        $this->dropTable('categories');
        $this->dropTable('auth');
        $this->dropTable('acl_privileges');
        $this->dropTable('acl_users_roles');
        $this->dropTable('acl_roles');
        $this->dropTable('users');
    }
}
