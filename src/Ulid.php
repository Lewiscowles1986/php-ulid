<?php

namespace lewiscowles\core;
use lewiscowles\core\ValueTypes\PositiveNumber;

final class Ulid
{
    const ENCODING = '0123456789ABCDEFGHJKMNPQRSTVWXYZ';
    const ENCODING_LENGTH = 32;

    /** @var TimeSourceInterface */
    private $timeSource;

    /** @var RandomFloatInterface */
    private $randomFloatSource;

    /** @var UlidTimeEncoder */
    private $timeEncoder;
    
    public function __construct(
        TimeSourceInterface $timeSource,
        RandomFloatInterface $randomFloatSource,
        UlidTimeEncoder $timeEncoder
    ) {
        $this->timeSource = $timeSource;
        $this->randomFloatSource = $randomFloatSource;
        $this->timeEncoder = $timeEncoder;
    }
    
    public function get(): string
    {
        return sprintf(
            '%s%s',
            $this->timeEncoder->encode($this->timeSource->getTime(), new PositiveNumber(10)),
            $this->encodeRandom(16)
        );
    }
    
    private function encodeRandom(int $length): string
    {
        $out = '';
        while ($length > 0) {
            $rand = (int) floor(self::ENCODING_LENGTH * $this->randomFloatSource->generate());
            $out = self::ENCODING[$rand] . $out;
            $length--;
        }

        return $out;
    }
}
