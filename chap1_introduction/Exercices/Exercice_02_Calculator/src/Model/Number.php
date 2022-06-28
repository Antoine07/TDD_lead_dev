<?php

namespace App\Model;

class Number
{

    public function __construct(private float $number)
    {
    }

    /**
     * Get the value of number
     */ 
    public function getNumber():float
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber(float $number):void
    {
        $this->number = $number;

    }
}
