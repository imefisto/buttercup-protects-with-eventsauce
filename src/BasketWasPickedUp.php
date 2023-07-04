<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

final class BasketWasPickedUp
{
    public function __construct(
        public readonly BasketId $basketId
    ) {
    }
}
