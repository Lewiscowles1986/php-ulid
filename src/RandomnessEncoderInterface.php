<?php

namespace lewiscowles\core;

use lewiscowles\core\ValueTypes\PositiveNumber;

interface RandomnessEncoderInterface
{
    public function encode(PositiveNumber $length): string;
}
