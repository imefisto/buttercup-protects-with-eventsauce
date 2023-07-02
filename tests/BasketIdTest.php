<?php

use Imefisto\ButtercupProtectsWithEventsauce\BasketId;

it(
    'should cast to string',
    function () {
        $basketId = BasketId::fromString('12345678-90ab-cdef-1234-567890abcedf1234');
        expect((string) $basketId)
            ->toBe('12345678-90ab-cdef-1234-567890abcedf1234');
    }
);

it(
    'should equal instances with the same type and value', 
    function () {
        expect ((new BasketId('same'))->equals(new BasketId('same')))
            ->toBeTrue();
    }
);

it(
    'should not equal instances with a different value',
    function () {
        expect ((new BasketId('other'))->equals(new BasketId('same')))
            ->toBeFalse();
    }
);
