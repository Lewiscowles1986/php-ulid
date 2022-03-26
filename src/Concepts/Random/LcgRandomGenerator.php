<?php

namespace lewiscowles\core\Concepts\Random;

class LcgRandomGenerator implements RandomFloatInterface
{
    public function generate(): float
    {
        return lcg_value();
    }
}
