<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

class ReverseNestedAggregation extends NestedAggregation
{
    protected function getType(): string
    {
        return 'reverse_nested';
    }
}
