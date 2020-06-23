<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\GroupRouteLocation;
use App\Entity\GroupRouteLocations;
use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use PDO;

final class DbalGroupRouteLocationRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAllForGroup(string $groupName): GroupRouteLocations
    {
        $statement = $this->connection->createQueryBuilder()
            ->select('*')
            ->from('`group`')
            ->where('name = :groupName')
            ->setParameter('groupName', strtolower($groupName))
            ->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $startTime           = $row['start_time'] ? new DateTimeImmutable($row['start_time']) : null;
        $endTime             = $row['end_time'] ? new DateTimeImmutable($row['end_time']) : null;
        $groupRouteLocations = [];

        $statement = $this->connection->createQueryBuilder()
            ->select('gr.*, l.picture_file_name, l.assignment')
            ->from('group_route', 'gr')
            ->join('gr', 'location', 'l', 'gr.location_id = l.id')
            ->where('gr.group_name = :groupName')
            ->setParameter('groupName', strtolower($groupName))
            ->execute();

        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $groupRouteLocations[] = $this->hydrateGroupRouteLocation($row);
        }

        return GroupRouteLocations::fromArray(
            $groupRouteLocations,
            $startTime,
            $endTime
        );
    }

    private function hydrateGroupRouteLocation(array $row): GroupRouteLocation
    {
        return GroupRouteLocation::createFromDataSource(
            (int) $row['id'],
            (int) $row['order'],
            $row['picture_file_name'],
            $row['uploaded_picture_file_name'] ?: null,
            $row['uploaded_picture_at'] ? new DateTimeImmutable($row['uploaded_picture_at']) : null,
            $row['assignment'],
            $row['assignment_result'] ?: null,
            $row['uploaded_picture_at'] ? new DateTimeImmutable($row['assignment_completed_at']) : null
        );
    }
}
