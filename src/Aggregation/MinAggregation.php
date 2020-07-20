<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

class MinAggregation extends MetricAggregation
{
    public function getMetricName(): string
    {
        return 'min';
    }
}
