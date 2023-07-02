<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

final class ProductWasAddedToBasket
{
    public function __construct(
        public readonly BasketId $basketId,
        public readonly ProductId $productId,
        public readonly string $productName
    ) {
    }
}
