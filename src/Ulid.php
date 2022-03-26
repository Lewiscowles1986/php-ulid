<?php

namespace lewiscowles\core;

use lewiscowles\core\ValueTypes\PositiveNumber;

final class Ulid
{
    /** @var TimeSourceInterface */
    private $timeSource;

    /** @var RandomnessEncoderInterface */
    private $randomEncoder;

    /** @var UlidTimeEncoder */
    private $timeEncoder;

    public function __construct(
        TimeSourceInterface $timeSource,
        UlidTimeEncoder $timeEncoder,
        RandomnessEncoderInterface $randomEncoder
    ) {
        $this->timeSource = $timeSource;
        $this->timeEncoder = $timeEncoder;
        $this->randomEncoder = $randomEncoder;
    }

    public function get(): string
    {
        return sprintf(
            '%s%s',
            $this->timeEncoder->encode($this->timeSource->getTime(), new PositiveNumber(10)),
            $this->randomEncoder->encode(new PositiveNumber(16))
        );
    }
}
