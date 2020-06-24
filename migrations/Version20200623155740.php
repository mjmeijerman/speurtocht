<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200623155740 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql(
            <<<EOQ
INSERT INTO `group` (`name`, `start_time`, `end_time`)
VALUES
	('mark', NULL, NULL),
	('nour', NULL, NULL);
EOQ
        );

        $this->addSql(
            <<<EOQ
INSERT INTO `group_route` (`id`, `group_name`, `location_id`, `order`, `uploaded_picture_file_name`, `uploaded_picture_at`, `assignment_result`, `assignment_completed_at`)
VALUES
	(1, 'mark', 1, 1, NULL, NULL, NULL, NULL),
	(2, 'mark', 2, 2, NULL, NULL, NULL, NULL),
	(3, 'mark', 3, 3, NULL, NULL, NULL, NULL),
	(4, 'mark', 4, 4, NULL, NULL, NULL, NULL),
	(5, 'mark', 5, 5, NULL, NULL, NULL, NULL),
	(6, 'mark', 6, 6, NULL, NULL, NULL, NULL),
	(7, 'mark', 7, 7, NULL, NULL, NULL, NULL),
	(8, 'mark', 8, 8, NULL, NULL, NULL, NULL),
	(9, 'nour', 6, 1, NULL, NULL, NULL, NULL),
	(10, 'nour', 5, 2, NULL, NULL, NULL, NULL),
	(11, 'nour', 4, 3, NULL, NULL, NULL, NULL),
	(12, 'nour', 3, 4, NULL, NULL, NULL, NULL),
	(13, 'nour', 2, 5, NULL, NULL, NULL, NULL),
	(14, 'nour', 1, 6, NULL, NULL, NULL, NULL),
	(15, 'nour', 7, 7, NULL, NULL, NULL, NULL),
	(16, 'nour', 8, 8, NULL, NULL, NULL, NULL);
EOQ
        );

        $this->addSql(
            <<<EOQ
INSERT INTO `location` (`id`, `picture_file_name`, `assignment`)
VALUES
	(1, 'static/zuiderpark_theater.png', 'Gooi een theezakje van een zo groot mogelijke afstand in een mok'),
	(2, 'static/skatepark.png', 'Maak een filmpje wat er heel indrukwekkend uitziet als je het filmpje achteruit afspeelt'),
	(3, 'static/otensien.png', 'Ga liggen of zitten met je ogen dicht. Sta op na precies 50 seconden'),
	(4, 'static/atletiek.png', 'Eet binnen 1 minuut zoveel mogelijk watermeloen'),
	(5, 'static/western_speeltuin.png', 'Gooi een ei zo hoog mogelijk in de lucht en vang hem weer op zonder dat deze kapot gaat'),
	(6, 'static/zwembad.png', 'Maak een piramide met minimaal 1 persoon in handstand. De handen van die persoon mogen niet op de grond staan.'),
	(7, 'static/herten.png', 'Tel het aantal rijstkorrels dat in het zakje zitten'),
	(8, 'static/waterspeeltuin.png', 'Vul de mok met water zonder hem aan te raken (Zet de mok niet vlakbij het water neer)');
EOQ
        );
    }

    public function down(Schema $schema) : void
    {
    }
}
