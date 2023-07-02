<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

final class ProductId
{
    public function __construct(public readonly string $id)
    {
    }

    public function equals(ProductId $other)
    {
        return $other->id == $this->id;
    }
}
