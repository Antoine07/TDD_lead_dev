<?php

use App\Calculator;
use App\Model\Add;
use App\Model\Divisor;
use App\Model\Number;
use App\Model\NumberString;
use App\Model\Sub;
use PHPUnit\Framework\TestCase;

class CalculModelTest extends TestCase
{

    protected Add $add;
    protected Divisor $divisor;
    protected Sub $sub;

    public function setUp(): void
    {
        $this->add = new Add;
        $this->divisor = new Divisor;
        $this->sub = new Sub;
    }

    public function testType()
    {
        // ReflectionClass est un design pattern qui fait une introspection de la classe
        $reflectAdd = new ReflectionClass(Add::class);
        $reflectDivisor = new ReflectionClass(Divisor::class);
        $reflectSub= new ReflectionClass(Sub::class);

        $this->assertTrue($reflectAdd->implementsInterface('App\\Model\\Calculable'));
        $this->assertTrue($reflectDivisor->implementsInterface('App\\Model\\Calculable'));
        $this->assertTrue($reflectSub->implementsInterface('App\\Model\\Calculable'));
    }

    public function testAdd()
    {
        $num1 = new Number(7);
        $num2 = new Number(8);
        $num3 = new NumberString(15);

        // (string) => permet d'exécuter la méthode __toString si elle est implémenée dans la classe
        $this->assertEquals( (string) $this->add->exec($num1, $num2), $num3);
    }

    public function testDivisor()
    {
        $num1 = new Number(7);
        $num2 = new Number(8);
        $num3 = new NumberString(7 / 8);

        $this->assertEquals((string) $this->divisor->exec($num1, $num2), $num3);
    }

    public function testException()
    {
        $this->expectException(\DivisionByZeroError::class);
        $this->expectExceptionMessage("Impossible de diviser par zéro");

        $num1 = new Number(7);
        $num2 = new Number(0);

        $this->divisor->exec($num1, $num2);
    }
}
