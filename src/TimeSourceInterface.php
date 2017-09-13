<?php

namespace lewiscowles\core;

interface TimeSourceInterface
{
    public function getTime(): int;
}
