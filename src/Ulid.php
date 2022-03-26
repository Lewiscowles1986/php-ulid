<?php

namespace lewiscowles\core;

use lewiscowles\core\ValueTypes\PositiveNumber;

final class Ulid
{
    /** @var RandomnessEncoderInterface */
    private $randomEncoder;

    /** @var UlidTimeEncoder */
    private $timeEncoder;

    public function __construct(
        UlidTimeEncoder $timeEncoder,
        RandomnessEncoderInterface $randomEncoder
    ) {
        $this->timeEncoder = $timeEncoder;
        $this->randomEncoder = $randomEncoder;
    }

    public function get(): string
    {
        return sprintf(
            '%s%s',
            $this->timeEncoder->encode(new PositiveNumber(10)),
            $this->randomEncoder->encode(new PositiveNumber(16))
        );
    }
}
