<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

final class ProductWasRemovedFromBasket
{
    public function __construct(
        private BasketId $basketId,
        private ProductId $productId
    ) {
        $this->basketId = $basketId;
        $this->productId = $productId;
    }
    
    public function getAggregateId()
    {
        return $this->basketId;
    }

    public function getProductId()
    {
        return $this->productId;
    }
}
