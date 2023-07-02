<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

final class ProductWasAddedToBasket
{
    public function __construct(
        private BasketId $basketId,
        private ProductId $productId,
        private string $productName
    ) {
        $this->basketId = $basketId;
        $this->productName = $productName;
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

    public function getProductName()
    {
        return $this->productName;
    }
}
