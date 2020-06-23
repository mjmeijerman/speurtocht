<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;

final class GroupRouteLocation
{
    private int $id;
    private int $order;
    private string $pictureLocation;
    private ?string $uploadedPictureLocation;
    private ?DateTimeImmutable $uploadedAt;
    private string $assignment;
    private ?string $assignmentAnswer;
    private ?DateTimeImmutable $assignmentCompletedAt;

    public static function createFromDataSource(
        int $id,
        int $order,
        string $pictureLocation,
        ?string $uploadedPictureLocation,
        ?DateTimeImmutable $uploadedAt,
        string $assignment,
        ?string $assignmentAnswer,
        ?DateTimeImmutable $assignmentCompletedAt
    ): self
    {
        $self = new self();

        $self->id                      = $id;
        $self->order                   = $order;
        $self->pictureLocation         = $pictureLocation;
        $self->uploadedPictureLocation = $uploadedPictureLocation;
        $self->uploadedAt              = $uploadedAt;
        $self->assignment              = $assignment;
        $self->assignmentAnswer        = $assignmentAnswer;
        $self->assignmentCompletedAt   = $assignmentCompletedAt;

        return $self;
    }

    public function compare(GroupRouteLocation $other): int
    {
        return ($this->order > $other->order()) ? 1 : -1;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function order(): int
    {
        return $this->order;
    }

    public function pictureLocation(): string
    {
        return $this->pictureLocation;
    }

    public function uploadedPictureLocation(): ?string
    {
        return $this->uploadedPictureLocation;
    }

    public function uploadedAt(): ?DateTimeImmutable
    {
        return $this->uploadedAt;
    }

    public function assignment(): string
    {
        return $this->assignment;
    }

    public function assignmentAnswer(): ?string
    {
        return $this->assignmentAnswer;
    }

    public function assignmentCompletedAt(): ?DateTimeImmutable
    {
        return $this->assignmentCompletedAt;
    }

    private function __construct()
    {
    }
}
