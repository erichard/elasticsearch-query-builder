<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

class AvgAggregation extends MetricAggregation
{
    protected function getType(): string
    {
        return 'avg';
    }
}