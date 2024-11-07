<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Contracts;

interface BindingInterface
{
    /**
     * Bind a service implementation to its corresponding interface in the
     *  configuration file.
     */
    public function binding(string $name): void;
}
