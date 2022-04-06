<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\MinAggregation;
use PHPUnit\Framework\TestCase;

class MinAggregationTest extends TestCase
{
    public function testItBuildTheAggregationUsingAField(): void
    {
        $query = new MinAggregation('min_price');
        $query->setField('price');

        $this->assertEquals([
            'min' => [
                'field' => 'price',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAScript(): void
    {
        $query = new MinAggregation('min_price');
        $query->setScript('doc.price.value');

        $this->assertEquals([
            'min' => [
                'script' => [
                    'source' => 'doc.price.value',
                ],
            ],
        ], $query->build());
    }

    public function testWithFieldName(): void
    {
        $query = new MinAggregation('min_price');

        $this->assertEquals([
            'min' => [
                'field' => 'min_price',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationWithMissingValue(): void
    {
        $query = new MinAggregation('min_price', 'price');
        $query->setMissing(10);

        $this->assertEquals([
            'min' => [
                'field' => 'price',
                'missing' => 10,
            ],
        ], $query->build());
    }
}
