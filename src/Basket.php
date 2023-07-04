<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

final class Basket implements AggregateRoot
{
    use AggregateRootBehaviour;

    public function __construct(private BasketId $id)
    {
    }

    public static function pickUp(BasketId $id): self
    {
        $basket = new self($id);

        $basket->recordThat(
            new BasketWasPickedUp($id)
        );

        return $basket;
    }

    public function addProduct(ProductId $productId, string $productName): void
    {
        $this->recordThat(
            new ProductWasAddedToBasket(
                $this->id,
                $productId,
                $productName
            )
        );
    }

    public function removeProduct(ProductId $productId): void
    {
        $this->recordThat(
            new ProductWasRemovedFromBasket(
                $this->id,
                $productId
            )
        );
    }

    public function applyBasketWasPickedUp(BasketWasPickedUp $event)
    {
    }

    public function applyProductWasAddedToBasket(ProductWasAddedToBasket $event)
    {
    }    

    public function applyProductWasRemovedFromBasket(ProductWasRemovedFromBasket $event)
    {
    }    
}
