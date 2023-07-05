<?php

use Imefisto\ButtercupProtectsWithEventsauce\Basket;
use Imefisto\ButtercupProtectsWithEventsauce\BasketId;
use Imefisto\ButtercupProtectsWithEventsauce\ProductId;
use Ramsey\Uuid\Uuid;

it(
    'should be the same after reconstitution',
    function () {
        $basketId = BasketId::fromString(Uuid::uuid7());
        $basket = Basket::pickUp($basketId);
        $productId = new ProductId('TPB1');
        $basket->addProduct($productId, "The Princess Bride");
        $basket->addProduct(new ProductId('TPB2'), "The book");
        $basket->removeProduct($productId);
        $events = $basket->releaseEvents();

        $generator = (function () use ($events) {
            yield from $events;
            return count($events);
        })();

        $reconstitutedBasket = Basket::reconstituteFromEvents(
            $basketId,
            $generator
        );

        expect($basket)
            ->toEqual($reconstitutedBasket);
    }
);
