<?php

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\SumAggregation;
use Erichard\ElasticQueryBuilder\QueryException;
use PHPUnit\Framework\TestCase;

class SumAggregationTest extends TestCase
{
    public function test_it_build_the_aggregation_using_a_field()
    {
        $query = new SumAggregation('sum_price');
        $query->setField('price');

        $this->assertEquals([
            'sum' => [
                'field' => 'price',
            ],
        ], $query->build());
    }

    public function test_it_build_the_aggregation_using_a_script()
    {
        $query = new SumAggregation('sum_price');
        $query->setScript('doc.price.value');

        $this->assertEquals([
            'sum' => [
                'script' => [
                    'source' => 'doc.price.value',
                ],
            ],
        ], $query->build());
    }

    public function test_it_fail_building_the_aggregation_without_field()
    {
        $query = new SumAggregation('sum_price');

        $this->expectException(QueryException::class);

        $query->build();
    }

    public function test_it_build_the_aggregation_with_missing_value()
    {
        $query = new SumAggregation('sum_price');
        $query->setField('price');
        $query->setMissing(10);

        $this->assertEquals([
            'sum' => [
                'field' => 'price',
                'missing' => 10,
            ],
        ], $query->build());
    }
}
