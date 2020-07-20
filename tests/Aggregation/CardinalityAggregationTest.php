<?php

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\CardinalityAggregation;
use Erichard\ElasticQueryBuilder\QueryException;
use PHPUnit\Framework\TestCase;

class CardinalityAggregationTest extends TestCase
{
    public function test_it_build_the_aggregation_using_a_field()
    {
        $query = new CardinalityAggregation('city');
        $query->setField('city');

        $this->assertEquals([
            'cardinality' => [
                'field' => 'city',
            ],
        ], $query->build());
    }

    public function test_it_build_the_aggregation_using_a_script()
    {
        $query = new CardinalityAggregation('city');
        $query->setScript('doc.city.value');

        $this->assertEquals([
            'cardinality' => [
                'script' => [
                    'source' => 'doc.city.value',
                ],
            ],
        ], $query->build());
    }

    public function test_it_fail_building_the_aggregation_without_field()
    {
        $query = new CardinalityAggregation('city');

        $this->expectException(QueryException::class);

        $query->build();
    }

    public function test_it_build_the_aggregation_with_missing_value()
    {
        $query = new CardinalityAggregation('city');
        $query->setField('city');
        $query->setMissing(10);

        $this->assertEquals([
            'cardinality' => [
                'field' => 'city',
                'missing' => 10,
            ],
        ], $query->build());
    }

    public function test_it_build_the_aggregation_with_a_precision_threshold()
    {
        $query = new CardinalityAggregation('city');
        $query->setField('city');
        $query->setPrecisionThreshold(100);

        $this->assertEquals([
            'cardinality' => [
                'field' => 'city',
                'precision_threshold' => 100,
            ],
        ], $query->build());
    }
}
