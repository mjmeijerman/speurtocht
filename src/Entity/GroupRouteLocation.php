<?php

declare(strict_types=1);

namespace App\Entity;

use DateInterval;
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
    private ?string $walkTime;

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

    public function setWalkTime(DateInterval $diff): void
    {
        $this->walkTime = $diff->i . ' minuten en ' . $diff->s . ' seconden';
    }

    public function walkTime(): ?string
    {
        return $this->walkTime;
    }

    public function assignmentDuration(): string
    {
        $diff = $this->assignmentCompletedAt->diff($this->uploadedAt);

        return $diff->i . ' minuten en ' . $diff->s . ' seconden';
    }

    public function uploadFile(string $fileName): void
    {
        $this->uploadedPictureLocation = $fileName;
        $this->uploadedAt              = new DateTimeImmutable();
    }

    public function answerAssignment(string $assignmentAnswer): void
    {
        $this->assignmentAnswer      = $assignmentAnswer;
        $this->assignmentCompletedAt = new DateTimeImmutable();
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
