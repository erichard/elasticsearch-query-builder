<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

trait HasDefaultOptions
{
    protected array $defaultOptions = [];

    public function getDefaultOptions(): array
    {
        return $this->defaultOptions;
    }

    public function setDefaultOptions(array $defaultOptions): self
    {
        $this->defaultOptions = $defaultOptions;

        return $this;
    }
}
