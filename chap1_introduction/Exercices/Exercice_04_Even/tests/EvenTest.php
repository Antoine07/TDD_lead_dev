<?php

use App\Even;
use PHPUnit\Framework\TestCase;

use Provider\TraitProvider;

class EvenTest extends TestCase
{
    use TraitProvider;
    protected Even $even ;

    public function setUp():void{
        $this->even = new Even(max : $_ENV['MAX'] ?? 100);
    }

     /**
     * @test testEvenNumber check number value
     * @dataProvider evenEqualsProvider
     */
    public function testEvenNumber($position, $expected){
        $current = 0;
        while($position > 0){
            $this->even->next();
            $position--;
            $current = $this->even->current();
        }

        $this->assertEquals($expected,$current );

    }
     

     /**
     * @test testEvenNumber check number value
     * @dataProvider evenEqualsYield
     */
    public function testEvenYieldNumber($position, $expected){
        $current = 0;
        while($position > 0){
            $this->even->next();
            $position--;
            $current = $this->even->current();
        }

        $this->assertEquals($expected,$current );

    }
}