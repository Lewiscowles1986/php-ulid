<?php

namespace lewiscowles\core;

use lewiscowles\core\ValueTypes\PositiveNumber;

interface TimeEncoderInterface
{
    public function encode(PositiveNumber $length): string;
}
