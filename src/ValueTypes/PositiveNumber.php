<?php

namespace lewiscowles\core\ValueTypes;

use DomainException;

final class PositiveNumber
{
    /** @var int */
    private $value;

    public function __construct(int $n) {
        if ($n < 0) {
            throw new DomainException("$n is not a positive number.");
        }
        $this->value = $n;
    }
    
    public function getValue(): int
    {
       return $this->value;
    }
}
