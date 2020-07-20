<?php

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\DateHistogramAggregation;
use Erichard\ElasticQueryBuilder\QueryException;
use PHPUnit\Framework\TestCase;

class DateHistogramAggregationTest extends TestCase
{
    public function test_it_cannot_be_built_without_field()
    {
        $aggregation = new DateHistogramAggregation('price_evolution');

        $this->expectException(QueryException::class);

        $aggregation->build();
    }

    public function test_it_cannot_be_built_without_calendar_interval()
    {
        $aggregation = new DateHistogramAggregation('price_evolution');
        $aggregation->setField('price');

        $this->expectException(QueryException::class);

        $aggregation->build();
    }

    public function test_it_build_the_aggregation()
    {
        $aggregation = new DateHistogramAggregation('price_evolution');
        $aggregation->setField('price');
        $aggregation->setCalendarInterval('1d');

        $this->assertEquals([
            'date_histogram' => [
                'field' => 'price',
                'calendar_interval' => '1d',
            ]
        ], $aggregation->build());
    }

    public function test_it_build_the_aggregation_recursivly()
    {
        $aggregation = new DateHistogramAggregation('price_evolution');
        $aggregation->setField('price');
        $aggregation->setCalendarInterval('1d');

        $this->assertEquals([
            'date_histogram' => [
                'field' => 'price',
                'calendar_interval' => '1d',
            ]
        ], $aggregation->build());
    }
}
