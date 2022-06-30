<?php

namespace Cart;

use SplObserver;
use SplSubject;

class Cart implements SplSubject
{

    // .2 <=> 0.2
    public function __construct(private Storable $storage, private float $tva = .2)
    {
    }

    public function buy(Productable $product, int $quantity): void
    {

        $total = abs($quantity * $product->getPrice() * ($this->tva + 1));

        $this->storage->setValue($product->getName(), $total);
    }

    public function reset(): void
    {
        $this->storage->reset();
    }

    public function restore(Productable $p): void
    {

        $this->storage->restore($p->getName());
    }

    public function total(): float
    {

        return round(array_sum($this->storage->getStorage()), $_ENV['APP_PRECISION'] ?? 3 );
    }

    public function attach(SplObserver $observer): void
    {
        
    }

    public function detach(SplObserver $observer): void
    {
        
    }

    public function notify(): void
    {
        
    }
}
