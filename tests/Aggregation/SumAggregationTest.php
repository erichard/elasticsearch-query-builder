<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\SumAggregation;
use PHPUnit\Framework\TestCase;

class SumAggregationTest extends TestCase
{
    public function testItBuildTheAggregationUsingAField(): void
    {
        $query = new SumAggregation('sum_price');
        $query->setField('price');

        $this->assertEquals([
            'sum' => [
                'field' => 'price',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAScript(): void
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

    public function testWithFieldName(): void
    {
        $query = new SumAggregation('sum_price');

        $this->assertEquals([
            'sum' => [
                'field' => 'sum_price',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationWithMissingValue(): void
    {
        $query = new SumAggregation('sum_price', 'price');
        $query->setMissing(10);

        $this->assertEquals([
            'sum' => [
                'field' => 'price',
                'missing' => 10,
            ],
        ], $query->build());
    }
}
