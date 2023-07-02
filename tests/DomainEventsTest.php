<?php

use Imefisto\ButtercupProtectsWithEventsauce\BasketId;
use Imefisto\ButtercupProtectsWithEventsauce\ProductId;
use Imefisto\ButtercupProtectsWithEventsauce\ProductWasAddedToBasket;

$event = new ProductWasAddedToBasket(
    new BasketId('BAS1'),
    new ProductId('PRO1'),
    'The Princess Bride'
);

it(
    'should equal another instance with the same value',
    function () use ($event) {
        expect (
            $event->getAggregateId()->equals(new BasketId('BAS1'))
        )->toBeTrue();
    }
);

it(
    'should expose a ProductId',
    function () use ($event) {
        expect (
            $event->getProductId()->equals(new ProductId('PRO1'))
        )->toBeTrue();
    }
);

it(
    'should expose a productName',
    function () use ($event) {
        expect($event->getProductName())
            ->toBe('The Princess Bride');
    }
);
