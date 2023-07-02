<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

use EventSauce\EventSourcing\AggregateRootId;

final class BasketId implements AggregateRootId
{
    public function __construct(private string $aggregateRootId)
    {
    }

    public function toString(): string
    {
        return $this->aggregateRootId;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public static function fromString(string $aggregateRootId): static
    {
        return new self($aggregateRootId);
    }

    public function equals(AggregateRootId $id)
    {
        return (string) $id == $this->aggregateRootId;
    }
}
