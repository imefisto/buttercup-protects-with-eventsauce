<?php

use EventSauce\EventSourcing\InMemoryMessageRepository;
use Imefisto\ButtercupProtectsWithEventsauce\Basket;
use Imefisto\ButtercupProtectsWithEventsauce\BasketId;
use Imefisto\ButtercupProtectsWithEventsauce\BasketRepository;
use Imefisto\ButtercupProtectsWithEventsauce\ProductId;
use Ramsey\Uuid\Uuid;

it(
    'should reconstitute a Basket to its state after persisting it',
    function () {
        $basketId = BasketId::fromString(Uuid::uuid7());
        $basket = Basket::pickUp($basketId);
        $basket->addProduct(new ProductId('TPB1'), "The Princess Bride");

        $baskets = new BasketRepository(new InMemoryMessageRepository());
        $baskets->persist($basket);
        $reconstitutedBasket = $baskets->retrieve($basketId);

        expect($basket)
            ->toEqual($reconstitutedBasket);
    }
);
