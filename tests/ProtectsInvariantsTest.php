<?php

use Imefisto\ButtercupProtectsWithEventsauce\Basket;
use Imefisto\ButtercupProtectsWithEventsauce\BasketId;
use Imefisto\ButtercupProtectsWithEventsauce\BasketLimitReached;
use Imefisto\ButtercupProtectsWithEventsauce\ProductId;
use Ramsey\Uuid\Uuid;

it(
    'should disallow adding a fourth product',
    function () {
        $basketId = BasketId::fromString(Uuid::uuid7());
        $basket = Basket::pickUp($basketId);
        $basket->addProduct(new ProductId('TPB1'), "The Princess Bride");
        $basket->addProduct(new ProductId('TPB2'), "The book");
        $basket->addProduct(new ProductId('TPB3'), "The DVD");
        $basket->addProduct(new ProductId('TPB4'), "The video game");
    }
)->throws(BasketLimitReached::class);;
