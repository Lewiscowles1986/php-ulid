<?php

namespace lewiscowles\core\Concepts\Time;

use lewiscowles\core\ValueTypes\PositiveNumber;

interface TimeEncoderInterface
{
    public function encode(PositiveNumber $length): string;
}
