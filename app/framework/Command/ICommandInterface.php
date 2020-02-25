<?php

declare(strict_types=1);

namespace Framework\Command;


interface ICommandInterface
{
    public function execute(): void;
}