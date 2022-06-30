<?php

use PHPUnit\Framework\TestCase;

use Cart\{Cart, Product, Storable};
use Dotenv\Exception\InvalidFileException;

class CartTest extends  TestCase
{
    protected $cart;
    protected Storable $mockStorage;

    public function setUp(): void
    {
        // Création d'un Mock
        $this->mockStorage = $this->createMock(Storable::class);

        $this->cart = new Cart($this->mockStorage);
        $this->cart->reset();
    }

    public function testAddOneProduct()
    {
        $apple = new Product('apple', 1.5);
        $this->mockStorage->method('getStorage')->willReturn(['apple' => round(10 * 1.5 * 1.2, 2)]);
        $this->cart->buy($apple, 10);
        $this->assertEquals($this->cart->total(), round(10 * 1.5 * 1.2, 2));
    }

    public function testTotalMultipleProducts()
    {

        $this->mockStorage->method('getStorage')->willReturn([
            'apple' => 10 * 1.5 * 1.2,
            'orange' => 10 * 1.2 * 1.2,
            'bananas' => 10 * 1.3 * 1.2,
        ]);
        $sum = 10 * 1.5 * 1.2 + 10 * 1.2 * 1.2 +  10 * 1.3 * 1.2;

        $this->assertEquals($this->cart->total(), round($sum, 2));
    }

    public function testCallResteMethodStorage()
    {
        $this->mockStorage->expects($this->once())->method('reset');
        $this->cart->reset();
    }

    public function testCallResetWhenBuyMethodStorage()
    {
        $apple = new Product('apple', 1.5);
        $this->mockStorage->expects($this->once())->method('setValue')->with($apple->getName(), abs(1.5 * 10 * 1.2));
        $this->cart->buy($apple, 10);
    }


    public function testRemoveAQuantityOfProductDoesntExist(){
        $orange = new Product('orange', 1.2);
        $this->mockStorage->method('getStorage')->willReturn([
            'apple' => 2 * 1.5 * 1.2,
        ]);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Ce produit n'existe pas.");
        $this->cart->restoreProduct($orange, 10);
    }

    public function testRemoveBadQuantityOfProduct(){
        $apple = new Product('apple', 1.5);
        $this->mockStorage->method('getStorage')->willReturn([
            'apple' => 10 * 1.5 * 1.2,
        ]);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Vous ne pouvez pas retirer plus que de quantité qu'il en existe.");
        $this->cart->restoreProduct($apple, 12);
    }

    public function testCallRestoreProductWhenMethodStorage()
    {
        $apple = new Product('apple', 1.5);
        $this->mockStorage->method('getStorage')->willReturn([
            'apple' => round( 10 * 1.5 * 1.2, 2 ),
        ]);
        $this->mockStorage->expects($this->once())->method('restoreQuantity')->with($apple->getName(), round( 9 * 1.5 * 1.2, 2 ));
        $this->cart->restoreProduct($apple, 1);
    }

}
