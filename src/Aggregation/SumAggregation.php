<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

class SumAggregation extends MetricAggregation
{
    protected function getType(): string
    {
        return 'sum';
    }
}
