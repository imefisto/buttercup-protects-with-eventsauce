<?php
namespace Imefisto\ButtercupProtectsWithEventsauce;

use EventSauce\EventSourcing\EventSourcedAggregateRootRepository;
use EventSauce\EventSourcing\MessageRepository;

class BasketRepository extends EventSourcedAggregateRootRepository
{
    public function __construct(MessageRepository $messageRepository) {
        parent::__construct(
            Basket::class,
            $messageRepository
        );
    }
}
