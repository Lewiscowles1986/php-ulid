<?php

namespace lewiscowles\core\Concepts\Time;

interface TimeSourceInterface
{
    public function getTime(): int;
}
