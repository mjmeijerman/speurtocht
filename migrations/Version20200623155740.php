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
	(1, 'zuiderpark_theater.jpg', 'Zuiderparktheater'),
	(2, 'skatepark.jpg', 'Skatepark'),
	(3, 'otensien.jpg', 'Ot en Sien speeltuin'),
	(4, 'atletiek.jpg', 'Atletiek'),
	(5, 'western_speeltuin.jpg', 'Western speeltuin'),
	(6, 'zwembad.jpg', 'Zwembad'),
	(7, 'herten.jpg', 'Herten'),
	(8, 'waterspeeltuin.jpg', 'Waterspeeltuin');
EOQ
        );
    }

    public function down(Schema $schema) : void
    {
    }
}
