<?php

declare(strict_types=1);

namespace App\Entity;

use ArrayIterator;
use DateTimeImmutable;
use IteratorAggregate;

final class GroupRouteLocations implements IteratorAggregate
{
    /**
     * @var GroupRouteLocation[]
     */
    private array $groupRouteLocations;

    private ?DateTimeImmutable $startTime;
    private ?DateTimeImmutable $endTime;

    /**
     * @param GroupRouteLocation[]   $groupRouteLocations
     * @param DateTimeImmutable|null $startTime
     * @param DateTimeImmutable|null $endTime
     *
     * @return $this
     */
    public static function fromArray(
        array $groupRouteLocations,
        ?DateTimeImmutable $startTime,
        ?DateTimeImmutable $endTime
    ): self
    {
        $self                      = new self();
        $self->groupRouteLocations = $groupRouteLocations;
        $self->startTime           = $startTime;
        $self->endTime             = $endTime;
        $self->sort();

        return $self;
    }

    public function findFirstUnfinished(): ?GroupRouteLocation
    {
        foreach ($this->groupRouteLocations as $groupRouteLocation) {
            if ($groupRouteLocation->uploadedPictureLocation() === null
                || $groupRouteLocation->assignmentAnswer() === null) {
                return $groupRouteLocation;
            }
        }

        return null;
    }

    public function sort(): void
    {
        usort(
            $this->groupRouteLocations,
            function (GroupRouteLocation $first, GroupRouteLocation $second) {
                return $first->compare($second);
            }
        );
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->groupRouteLocations);
    }

    public function startTime(): ?DateTimeImmutable
    {
        return $this->startTime;
    }

    public function endTime(): ?DateTimeImmutable
    {
        return $this->endTime;
    }

    private function __construct()
    {
    }
}
