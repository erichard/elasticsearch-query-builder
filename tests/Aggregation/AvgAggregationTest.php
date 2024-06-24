<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\AvgAggregation;
use Erichard\ElasticQueryBuilder\Options\SourceScript;
use PHPUnit\Framework\TestCase;

class AvgAggregationTest extends TestCase
{
    public function testBuildWithNameOnly(): void
    {
        $query = new AvgAggregation('avg_price');

        $this->assertEquals([
            'avg' => [
                'field' => 'avg_price',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAField(): void
    {
        $query = new AvgAggregation('avg_price');
        $query->setField('price');

        $this->assertEquals([
            'avg' => [
                'field' => 'price',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAScript(): void
    {
        $query = new AvgAggregation('avg_price', new SourceScript('doc.price.value'));

        $this->assertEquals([
            'avg' => [
                'script' => [
                    'source' => 'doc.price.value',
                ],
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAScriptViaSet(): void
    {
        $query = new AvgAggregation('avg_price');
        $query->setScript('doc.price.value');

        $this->assertEquals([
            'avg' => [
                'script' => [
                    'source' => 'doc.price.value',
                ],
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationWithMissingValue(): void
    {
        $query = new AvgAggregation('avg_price');
        $query->setField('price');
        $query->setMissing(10);

        $this->assertEquals([
            'avg' => [
                'field' => 'price',
                'missing' => 10,
            ],
        ], $query->build());
    }
}
