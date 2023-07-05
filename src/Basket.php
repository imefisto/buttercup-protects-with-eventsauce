<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

final class Basket implements AggregateRoot
{
    private array $products = [];
    private int $productCount = 0;

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
        $this->guardProductLimit();

        $this->recordThat(
            new ProductWasAddedToBasket(
                $this->id,
                $productId,
                $productName
            )
        );
    }

    private function guardProductLimit()
    {
        if ($this->productCount >= 3) {
            throw new BasketLimitReached;
        }
    }

    public function removeProduct(ProductId $productId): void
    {
        if(! $this->productIsInBasket($productId)) {
            return;
        }
        
        $this->recordThat(
            new ProductWasRemovedFromBasket(
                $this->id,
                $productId
            )
        );
    }

    private function productIsInBasket(ProductId $productId): bool
    {
        return
            array_key_exists((string) $productId, $this->products)
            && $this->products[(string)$productId] > 0;
    }

    public function applyBasketWasPickedUp(BasketWasPickedUp $event)
    {
        $this->product = [];
        $this->productCount = 0;
    }

    public function applyProductWasAddedToBasket(ProductWasAddedToBasket $event)
    {
        $productId = $event->productId;

        if(!$this->productIsInBasket($productId)) {
            $this->products[(string) $productId] = 0;
        }

        ++$this->products[(string) $productId];
        ++$this->productCount;
    }    

    public function applyProductWasRemovedFromBasket(ProductWasRemovedFromBasket $event)
    {
        --$this->products[(string) $event->productId];
        --$this->productCount;
    }    
}
