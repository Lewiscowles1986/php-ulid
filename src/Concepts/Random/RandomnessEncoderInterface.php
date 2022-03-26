<?php

namespace lewiscowles\core\Concepts\Random;

use lewiscowles\core\ValueTypes\PositiveNumber;

interface RandomnessEncoderInterface
{
    public function encode(PositiveNumber $length): string;
}
