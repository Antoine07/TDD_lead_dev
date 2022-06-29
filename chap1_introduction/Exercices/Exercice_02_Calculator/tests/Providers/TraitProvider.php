<?php

namespace Providers;

trait TraitProvider{

    public function additionEqualsProvider(): array
    {

        return [
            [
                0, 0, 0
            ],
            [
                0, 1, 1
            ],
            [
                1, 0, 1
            ],
            [
                1, 1, 2
            ],
            [
                9, 8, 17
            ],
            [
                10, 12, 22
            ],
        ];
    }

    public function additionSameProvider(): array
    {

        return [
            [
                0., 0., 0.
            ],
            [
                0.,1., 1.
            ],
            [
                1., 0., 1.
            ],
            [
                1., 1., 2.
            ],
            [
                9., 8., 17.
            ],
            [
                10., 12., 22.
            ],
        ];
    }

    public function divisorEqualsProvider(): array
    {

        return [
            [
                1, 1, 1
            ],
            [
                4,2, 2
            ],
            [
                18, 2, 9
            ],
            [
                15, 7, 2.14 // precision 2
            ],
            [
                19, 7, 2.71
            ],
            [
                10, 12, 0.83
            ],
        ];
    }

    public function divisorSameProvider(): array
    {

        return [
            [
                1., 1., 1.
            ],
            [
                4.,2., 2.
            ],
            [
                18., 2., 9.
            ],
            [
                15., 7., 2.14 // precision 2
            ],
            [
                19., 7., 2.71
            ],
            [
                10., 12., 0.83
            ],
        ];
    }
}