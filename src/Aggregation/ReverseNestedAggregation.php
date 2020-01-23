<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

class ReverseNestedAggregation extends Aggregation
{
    private $aggregation;
    private $path;

    public function setPath(string $path)
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
            'reverse_nested' => [
                'path' => $this->path,
            ],
            'aggs' => [
                $this->aggregation->getName() => $this->aggregation->build(),
            ],
        ];
    }
}
