<?php

namespace App\Model;

class Sub implements Calculable
{
    public function exec(Number $a, Number $b): NumberString
    {

        return new NumberString($a->getNumber() - $b->getNumber());
    }
}
