<?php

namespace lewiscowles\core\Tests\Support;

use lewiscowles\core\Concepts\Time\TimeSourceInterface;

final class CannedTimeSource implements TimeSourceInterface
{
    /** @var int */
    private $timeSet;

    public function __construct(int $timeSet)
    {
        $this->timeSet = $timeSet;
    }

    public function getTime(): int
    {
        return $this->timeSet;
    }
}
