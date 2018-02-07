<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Filter\Filter;

class FilterAggregation extends Aggregation
{
    private $aggregation;
    private $filter;

    public function setFilter(Filter $filter)
    {
        $this->filter = $filter;

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
            'filter' => $this->filter->build(),
            'aggs' => [
                $this->aggregation->getName() => $this->aggregation->build(),
            ],
        ];
    }
}
