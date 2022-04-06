<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

class MinAggregation extends MetricAggregation
{
    protected function getType(): string
    {
        return 'min';
    }
}
