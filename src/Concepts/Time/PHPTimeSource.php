<?php

namespace lewiscowles\core\Concepts\Time;

class PHPTimeSource implements TimeSourceInterface
{
    public function getTime(): int
    {
        return (int) (microtime(true) * 1000);
    }
}
