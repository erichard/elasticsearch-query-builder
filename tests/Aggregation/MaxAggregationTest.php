<?php

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\MaxAggregation;
use Erichard\ElasticQueryBuilder\QueryException;
use PHPUnit\Framework\TestCase;

class MaxAggregationTest extends TestCase
{
    public function test_it_build_the_aggregation_using_constructor()
    {
        $query = new MaxAggregation('price');

        $this->assertEquals([
            'max' => [
                'field' => 'price',
            ],
        ], $query->build());
    }

    public function test_it_build_the_aggregation_using_a_field()
    {
        $query = new MaxAggregation();
        $query->setField('price');

        $this->assertEquals([
            'max' => [
                'field' => 'price',
            ],
        ], $query->build());
    }

    public function test_it_build_the_aggregation_using_a_script()
    {
        $query = new MaxAggregation();
        $query->setScript('doc.price.value');

        $this->assertEquals([
            'max' => [
                'script' => [
                    'source' => 'doc.price.value',
                ],
            ],
        ], $query->build());
    }

    public function test_it_fail_building_the_aggregation_without_field()
    {
        $query = new MaxAggregation();

        $this->expectException(QueryException::class);

        $query->build();
    }

    public function test_it_build_the_aggregation_with_missing_value()
    {
        $query = new MaxAggregation('price');
        $query->setMissing(10);

        $this->assertEquals([
            'max' => [
                'field' => 'price',
                'missing' => 10,
            ],
        ], $query->build());
    }
}
