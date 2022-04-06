<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\StatsAggregation;
use PHPUnit\Framework\TestCase;

class StatsAggregationTest extends TestCase
{
    public function testItBuildTheAggregationUsingAField(): void
    {
        $query = new StatsAggregation('price');
        $query->setField('price');

        $this->assertEquals([
            'stats' => [
                'field' => 'price',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAScript(): void
    {
        $query = new StatsAggregation('price');
        $query->setScript('doc.price.value');

        $this->assertEquals([
            'stats' => [
                'script' => [
                    'source' => 'doc.price.value',
                ],
            ],
        ], $query->build());
    }

    public function testWithFieldName(): void
    {
        $query = new StatsAggregation('price');

        $this->assertEquals([
            'stats' => [
                'field' => 'price',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationWithMissingValue(): void
    {
        $query = new StatsAggregation('price', 'price');
        $query->setMissing(10);

        $this->assertEquals([
            'stats' => [
                'field' => 'price',
                'missing' => 10,
            ],
        ], $query->build());
    }
}
