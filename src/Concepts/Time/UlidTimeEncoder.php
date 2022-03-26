<?php

namespace lewiscowles\core\Concepts\Time;

use lewiscowles\core\ValueTypes\PositiveNumber;

final class UlidTimeEncoder implements TimeEncoderInterface
{
    private const ENCODING = '0123456789ABCDEFGHJKMNPQRSTVWXYZ';
    private const ENCODING_LENGTH = 32;

    /** @var TimeSourceInterface */
    private $timeSource;

    public function __construct(TimeSourceInterface $timeSource)
    {
        $this->timeSource = $timeSource;
    }

    public function encode(PositiveNumber $desiredLength): string
    {
        $time = $this->timeSource->getTime();
        $out = '';
        while (strlen($out) < $desiredLength->getValue()) {
            $mod = intval($time % self::ENCODING_LENGTH);
            $out = self::ENCODING[$mod] . $out;
            $time = ($time - $mod) / self::ENCODING_LENGTH;
        }

        return $out;
    }
}
