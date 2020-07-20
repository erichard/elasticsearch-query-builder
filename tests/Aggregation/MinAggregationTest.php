<?php

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\MinAggregation;
use Erichard\ElasticQueryBuilder\QueryException;
use PHPUnit\Framework\TestCase;

class MinAggregationTest extends TestCase
{
    public function test_it_build_the_aggregation_using_constructor()
    {
        $query = new MinAggregation('price');

        $this->assertEquals([
            'min' => [
                'field' => 'price',
            ],
        ], $query->build());
    }

    public function test_it_build_the_aggregation_using_a_field()
    {
        $query = new MinAggregation();
        $query->setField('price');

        $this->assertEquals([
            'min' => [
                'field' => 'price',
            ],
        ], $query->build());
    }

    public function test_it_build_the_aggregation_using_a_script()
    {
        $query = new MinAggregation();
        $query->setScript('doc.price.value');

        $this->assertEquals([
            'min' => [
                'script' => [
                    'source' => 'doc.price.value',
                ],
            ],
        ], $query->build());
    }

    public function test_it_fail_building_the_aggregation_without_field()
    {
        $query = new MinAggregation();

        $this->expectException(QueryException::class);

        $query->build();
    }

    public function test_it_build_the_aggregation_with_missing_value()
    {
        $query = new MinAggregation('price');
        $query->setMissing(10);

        $this->assertEquals([
            'min' => [
                'field' => 'price',
                'missing' => 10,
            ],
        ], $query->build());
    }
}
