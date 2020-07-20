<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

class MaxAggregation extends MinAggregation
{
    public function build(): array
    {
        return [
            'max' => parent::build()['min'],
        ];
    }
}
