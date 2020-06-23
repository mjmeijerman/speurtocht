<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20200623154040 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('location');
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true, 'length' => 11]);
        $table->addColumn('picture_file_name', Types::STRING, ['length' => 255]);
        $table->addColumn('assignment', Types::STRING, ['length' => 255]);
        $table->setPrimaryKey(['id']);

        $table = $schema->createTable('group_route');
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true, 'length' => 11]);
        $table->addColumn('group_name', Types::STRING, ['length' => 255]);
        $table->addColumn('location_id', Types::INTEGER, [11]);
        $table->addColumn('order', Types::INTEGER, [11]);
        $table->addColumn('uploaded_picture_file_name', Types::STRING, ['notnull' => false]);
        $table->addColumn('uploaded_picture_at', Types::DATETIME_IMMUTABLE, ['notnull' => false]);
        $table->addColumn('assignment_result', Types::STRING, ['notnull' => false]);
        $table->addColumn('assignment_completed_at', Types::DATETIME_IMMUTABLE, ['notnull' => false]);
        $table->setPrimaryKey(['id']);

        $table = $schema->createTable('group');
        $table->addColumn('name', Types::STRING, ['length' => 20]);
        $table->addColumn('start_time', Types::DATETIME_IMMUTABLE, ['notnull' => false]);
        $table->addColumn('end_time', Types::DATETIME_IMMUTABLE, ['notnull' => false]);
        $table->setPrimaryKey(['name']);
    }

    public function down(Schema $schema): void
    {
    }
}
