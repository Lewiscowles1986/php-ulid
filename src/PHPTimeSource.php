<?php

namespace lewiscowles\core;

class PHPTimeSource implements TimeSourceInterface
{
    public function getTime(): int
    {
        return time();
    }
}
