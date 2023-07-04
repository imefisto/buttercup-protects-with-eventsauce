<?php

use Imefisto\ButtercupProtectsWithEventsauce\Basket;
use Imefisto\ButtercupProtectsWithEventsauce\BasketId;
use Imefisto\ButtercupProtectsWithEventsauce\ProductId;
use Ramsey\Uuid\Uuid;

it(
    'should not record an event when removing a Product that is no longer in the Basket',
    function () {
        $basketId = BasketId::fromString(Uuid::uuid7());
        $basket = Basket::pickUp($basketId);
        $productId = new ProductId('TPB1');
        $basket->addProduct($productId, "The Princess Bride");
        $basket->removeProduct($productId);
        $basket->removeProduct($productId);

        expect(
            $basket->releaseEvents()
        )->toHaveCount(3);
    }
);
