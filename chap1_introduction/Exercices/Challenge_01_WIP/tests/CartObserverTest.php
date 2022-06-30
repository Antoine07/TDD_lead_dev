<?php
use PHPUnit\Framework\TestCase;
use Cart\{Cart, Product, Storable};

class CartObserverTest extends TestCase
{
    protected Cart $cart;
    protected Storable $mockStorage;
    protected int $precision;

    public function setUp(): void
    {
        $this->mockStorage = $this->createMock(Storable::class);
        $this->cart = new Cart($this->mockStorage);
        $this->cart->reset();
        $this->precision = $_ENV['PRECISION'];
    }

    public function testAmount(){
        $product = new Product(name : 'superApple', price : 5.5);

        $this->cart->buy(product : $product, quantity: 10 );
    }
}
