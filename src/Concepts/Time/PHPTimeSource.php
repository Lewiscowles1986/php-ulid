<?php

namespace lewiscowles\core\Concepts\Time;

class PHPTimeSource implements TimeSourceInterface
{
    public function getTime(): int
    {
        return hrtime(true);
    }
}
