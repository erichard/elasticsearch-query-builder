<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

class NestedAggregation extends Aggregation
{
    private $aggregation;
    private $path;

    public function setNestedPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    public function setAggregation(Aggregation $aggregation)
    {
        $this->aggregation = $aggregation;

        return $this;
    }

    public function build(): array
    {
        return [
            'nested' => [
                'path' => $this->path,
            ],
            'aggs' => [
                $this->aggregation->getName() => $this->aggregation->build(),
            ],
        ];
    }
}
