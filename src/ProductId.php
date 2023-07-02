<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

final class ProductId
{
    public function __construct(private string $id)
    {
    }

    public function equals(ProductId $id)
    {
        return (string) $id == $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
