<?php

namespace lewiscowles\core;

class LcgRandomGenerator implements RandomFloatInterface
{
    public function generate(): float
    {
        return lcg_value();
    }
}
