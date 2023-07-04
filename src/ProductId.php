<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

final class ProductId
{
    public function __construct(private string $id)
    {
    }

    public function equals(ProductId $other)
    {
        return (string) $other == $this->id;
    }

    public function __toString()
    {
        return $this->id;
    }
}
