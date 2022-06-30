<?php

namespace Cart;

class Cart
{


    // .2 <=> 0.2
    public function __construct(private Storable $storage, private float $tva = .2)
    {
    }

    public function buy(Productable $p, int $quantity): void
    {

        $total = abs($quantity * $p->getPrice() * ($this->tva + 1));
        $this->storage->setValue($p->getName(), $total); // le storage n'est pas à tester ou alors séparemment
    }

    public function reset(): void
    {
        $this->storage->reset();
    }

    public function restoreProduct(Productable $product, int $quantity): void
    {
        $store = $this->storage->getStorage()[$product->getName()] ?? false;
        if ($store === false) throw new \InvalidArgumentException("Ce produit n'existe pas.");

        $restore =  $store - $product->getPrice() * $quantity * ($this->tva + 1);

        if ($restore < 0) throw new \InvalidArgumentException("Vous ne pouvez pas retirer plus que de quantité qu'il en existe.");

        $this->storage->restoreQuantity(name: $product->getName(), quantity: $restore);
    }

    public function restore(Productable $p): void
    {
        $this->storage->restore($p->getName());
    }

    public function total(): float
    {
        return round(array_sum($this->storage->getStorage()), $_ENV['PRECISION'] ?? 2);
    }
}
