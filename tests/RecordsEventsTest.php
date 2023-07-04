<?php

use Imefisto\ButtercupProtectsWithEventsauce\Basket;
use Imefisto\ButtercupProtectsWithEventsauce\BasketId;
use Imefisto\ButtercupProtectsWithEventsauce\ProductId;
use Ramsey\Uuid;

$basketId = BasketId::fromString(Uuid::uuid7());
$basket = Basket::pickUp($basketId);
$basket->addProduct(new ProductId('TPB123'), 'The Princess Bride');
$basket->removeProduct(new ProductId('TPB123'));

$events = $basket->getRecordedEvents();

it(
    'should have recorded 3 events',
    function () use ($events) {
        expect($events)->toHaveCount(3);
    }
);

it(
    'should have a BasketWasPickedUp event',
    function () use ($events) {
        expect($events[0])->toBeInstanceOf(BasketWasPickedUp::class);
    }
);

it(
    'should have a ProductWasAddedToBasket event',
    function () {
        expect($events[1])->toBeInstanceOf(ProductWasAddedToBasket::class);
    }
);

it(
    'should have a ProductWasRemovedFromBasket event',
    function () {
        expect($events[2])->toBeInstanceOf(ProductWasRemovedFromBasket::class);
    }
);
