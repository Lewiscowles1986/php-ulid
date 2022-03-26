<?php

namespace lewiscowles\core;

use lewiscowles\core\ValueTypes\PositiveNumber;

interface TimeEncoderInterface
{
    public function encode(int $time, PositiveNumber $length): string;
}
