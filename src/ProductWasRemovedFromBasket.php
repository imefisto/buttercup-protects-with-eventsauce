<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

final class ProductWasRemovedFromBasket
{
    public function __construct(
        public readonly BasketId $basketId,
        public readonly ProductId $productId
    ) {
    }
}
