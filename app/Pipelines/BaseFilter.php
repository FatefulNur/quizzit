<?php

namespace App\Pipelines;

abstract class BaseFilter
{
    abstract public function getFilters(): array;

    public function getResults(array $contents)
    {
        return app('pipeline')
            ->send($contents)
            ->through($this->getFilters())
            ->then(fn($contents) => $contents['builder']);
    }
}
