<?php

namespace lewiscowles\core;

use lewiscowles\core\ValueTypes\PositiveNumber;

final class UlidTimeEncoder implements TimeEncoderInterface
{
    private const ENCODING = '0123456789ABCDEFGHJKMNPQRSTVWXYZ';
    private const ENCODING_LENGTH = 32;

    public function encode(int $time, PositiveNumber $desiredLength): string
    {
        $out = '';
        for ($i = 0; $i < $desiredLength->getValue(); $i++) {
            $mod = (int) ($time % self::ENCODING_LENGTH);
            $out = self::ENCODING[$mod] . $out;
            $time = ($time - $mod) / self::ENCODING_LENGTH;
        }

        return $out;
    }
}
