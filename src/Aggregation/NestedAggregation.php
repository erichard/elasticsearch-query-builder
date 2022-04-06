<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

class NestedAggregation extends AbstractAggregation
{
    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public function __construct(
        string $name,
        private string $path,
        array $aggregations = []
    ) {
        parent::__construct($name, $aggregations);
    }

    public function setNestedPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getNestedPath(): string
    {
        return $this->path;
    }

    protected function getType(): string
    {
        return 'nested';
    }

    protected function buildAggregation(): array
    {
        return [
            'path' => $this->path,
        ];
    }
}
