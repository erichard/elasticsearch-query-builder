<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

class SumAggregation extends MetricAggregation
{
    public function getMetricName(): string
    {
        return 'sum';
    }
}
