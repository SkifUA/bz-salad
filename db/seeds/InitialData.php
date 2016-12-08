<?php

use Phinx\Seed\AbstractSeed;

class InitialData extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $this->query("
            /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!40101 SET NAMES utf8 */;
            /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
            /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
            /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
          ");

        $this->query("
            INSERT INTO `acl_privileges` (`roleId`, `module`, `privilege`)
            VALUES
              (1,'acl','Management'),
              (1,'acl','View'),
              (1,'cache','Management'),
              (1,'categories','Management'),
              (1,'dashboard','Dashboard'),
              (1,'media','Management'),
              (1,'media','Upload'),
              (1,'options','Management'),
              (1,'pages','Management'),
              (1,'system','Info'),
              (1,'users','EditEmail'),
              (1,'users','EditPassword'),
              (1,'users','Management'),
              (1,'users','ViewProfile'),
              (2,'media','Upload'),
              (2,'users','EditEmail'),
              (2,'users','EditPassword'),
              (2,'users','ViewProfile'),
              (3,'users','ViewProfile'),
              (4,'cache','Management')
            ;
        ");
        

        $this->query("
            INSERT INTO `acl_roles` (`id`, `name`)
            VALUES
                (1,'admin'),
                (2,'member'),
                (3,'guest'),
                (4,'system'),
                (5,'manager'),
                (6,'groupteamlead'),
                (7,'developer'),
                (8,'grouptechlead'),
                (9,'techlead'),
                (10,'teamlead')
            ;
        ");

        $this->query("
            INSERT INTO `acl_users_roles` (`userId`, `roleId`)
            VALUES
                (0,4),
                (1,1);
        ");

        $this->query("
            INSERT INTO `auth` (`userId`, `provider`, `foreignKey`, `token`, `tokenSecret`, `tokenType`)
            VALUES
                (1,'equals','admin','$2y$10$4a454775178c3f89d510fud2T.xtw01Ir.Jo.91Dr3nL2sz3OyVpK','','access');
        ");

        $this->query("
        INSERT INTO `users` (`id`, `login`, `email`, `created`, `updated`, `status`)
        VALUES
            (0,'system',NULL,'2012-11-09 07:37:58',NULL,'disabled'),
            (1,'admin',NULL,'2012-11-09 07:38:41',NULL,'active')
            ;
        ");



        $this->query("
            /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
            /*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
            /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
        ");
    }
}