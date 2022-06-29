<?php
// Framework de tests PHPUNIT

use App\Calculator;
use PHPUnit\Framework\TestCase;

use Providers\TraitProvider;

class CalculatorTest extends TestCase
{
    use TraitProvider;

    protected Calculator $calculator;

    public function setUp(): void
    {
        $this->calculator = new Calculator($_ENV['PRECISION'] ?? 2);
    }

    /**
     * @test testPrecision 
     */
    public function testPrecision(): void
    {
        $this->assertEquals( $_ENV['PRECISION'] , $this->calculator->getPrecision());
    }

    /**
     * @test testInstanceOfCalculator object Calculator exists
     */
    public function testInstanceOfCalculator(): void
    {
        $this->assertInstanceOf(Calculator::class, $this->calculator);
    }

    /**
     * @test testAdd
     * @dataProvider additionEqualsProvider
     */
    public function testAdd($a, $b, $expected): void
    {

        $this->assertEquals($expected, $this->calculator->add($a, $b));
    }

    /**
     * @test testSameAdd check type
     * @dataProvider additionSameProvider
     */
    public function testSameAdd($a, $b, $expected): void
    {

        $this->assertSame($expected, $this->calculator->add($a, $b));
    }

    /**
     * @test testEqualsDivisor check type
     * @dataProvider divisorEqualsProvider
     */
    public function testEqualsDivisor($a, $b, $expected): void
    {
        $this->assertEquals($expected, $this->calculator->division($a, $b));
       
    }

    /**
     * @test testSameDivisor check type
     * @dataProvider divisorSameProvider
     */
    public function testSameDivisor($a, $b, $expected): void
    {
        $this->assertSame($expected, $this->calculator->division($a, $b));
    }

    /**
     * @test testExceptionDivision division by zero
     */
    public function testExceptionDivision(): void
    {
        $this->expectException(\DivisionByZeroError::class);
        $this->calculator->division(3, 0);
    }

    /**
     * @test testExceptionMessageDivision Message division by zero
     */
    public function testExceptionMessageDivision(): void
    {
        $this->expectExceptionMessage("Impossible de diviser par zéro");
        $this->calculator->division(3, 0);
    }
}
