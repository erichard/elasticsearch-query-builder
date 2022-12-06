<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

class MaxAggregation extends MetricAggregation
{
    protected function getType(): string
    {
        return 'max';
    }
}
