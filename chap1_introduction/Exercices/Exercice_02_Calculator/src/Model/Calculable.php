<?php

namespace App\Model;

interface Calculable
{
    public function exec(Number $a, Number $b):NumberString;
}
