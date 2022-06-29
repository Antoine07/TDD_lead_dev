<?php

namespace Provider;

use Generator;

trait TraitProvider{

    private int $max = 100;

    public function evenEqualsProvider(): array
    {

        return [
            [
                0, 0
            ],
            [
                1, 2
            ],
            [
                2, 4
            ],
            [
                3, 6
            ],
            [
                4, 8
            ],
            [
                5, 10
            ],
        ];
    }

    public function evenEqualsYield(){
        [$pos, $curr] = [0, 0];
        while($this->max > 0){
            yield [$pos, $curr];
            $pos++;
            $curr = $curr + 2;
            $this->max--;
        }
    }
}