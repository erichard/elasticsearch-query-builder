<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\DateHistogramAggregation;
use PHPUnit\Framework\TestCase;

class DateHistogramAggregationTest extends TestCase
{
    public function testWithoutDifferentField(): void
    {
        $aggregation = new DateHistogramAggregation('price_evolution', '1d');

        $this->assertEquals([
            'date_histogram' => [
                'field' => 'price_evolution',
                'calendar_interval' => '1d',
            ],
        ], $aggregation->build());
    }

    public function testWithDifferentName(): void
    {
        $aggregation = new DateHistogramAggregation('price_evolution', '1d', 'price');

        $this->assertEquals([
            'date_histogram' => [
                'field' => 'price',
                'calendar_interval' => '1d',
            ],
        ], $aggregation->build());
    }

    public function testItBuildTheAggregationWithSet(): void
    {
        $aggregation = new DateHistogramAggregation('price_evolution', '1d', 'price');

        $aggregation->setField('price2');
        $aggregation->setCalendarInterval('2d');

        $this->assertEquals([
            'date_histogram' => [
                'field' => 'price2',
                'calendar_interval' => '2d',
            ],
        ], $aggregation->build());
    }

    public function testWithExtendedBounds(): void
    {
        $nameAndField = 'per_day';
        $calendarInterval = 'day';
        $field = 'date';
        $min = '2022-01-10';
        $max = '2022-01-20';

        $aggregation = new DateHistogramAggregation($nameAndField, $calendarInterval, $field, [], $min, $max);

        $this->assertEquals([
            'date_histogram' => [
                'field' => $field,
                'calendar_interval' => $calendarInterval,
                'extended_bounds' => [
                    'min' => $min,
                    'max' => $max,
                ],
            ],
        ], $aggregation->build());
    }
}
