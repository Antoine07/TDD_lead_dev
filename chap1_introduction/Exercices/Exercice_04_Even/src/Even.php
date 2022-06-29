<?php

namespace App;

use Iterator;

class Even implements Iterator{

    public function __construct(
        private int $max = 100,
        private int $current = 0,
        private int $position = 0
    )
    {
        
    }

    public function rewind(): void
    {
        $this->current = 0;
        $this->position = 0;
    }

    public function current(): int
    {
        return $this->current ;
    }

    public function key(): int
    {
        return $this->position ;
    }

    public function next(): void
    {
        $this->position++;
        $this->current = $this->current + 2;
    }

    public function valid(): bool
    {
        return $this->position < $this->max ;
    }

}