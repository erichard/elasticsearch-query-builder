<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\MaxAggregation;
use Erichard\ElasticQueryBuilder\Options\SourceScript;
use PHPUnit\Framework\TestCase;

class MaxAggregationTest extends TestCase
{
    public function testBuildWithNameOnly(): void
    {
        $query = new MaxAggregation('max_price');

        $this->assertEquals([
            'max' => [
                'field' => 'max_price',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAField(): void
    {
        $query = new MaxAggregation('max_price');
        $query->setField('price');

        $this->assertEquals([
            'max' => [
                'field' => 'price',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAScript(): void
    {
        $query = new MaxAggregation('max_price', new SourceScript('doc.price.value'));

        $this->assertEquals([
            'max' => [
                'script' => [
                    'source' => 'doc.price.value',
                ],
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAScriptViaSet(): void
    {
        $query = new MaxAggregation('max_price');
        $query->setScript('doc.price.value');

        $this->assertEquals([
            'max' => [
                'script' => [
                    'source' => 'doc.price.value',
                ],
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationWithMissingValue(): void
    {
        $query = new MaxAggregation('max_price');
        $query->setField('price');
        $query->setMissing(10);

        $this->assertEquals([
            'max' => [
                'field' => 'price',
                'missing' => 10,
            ],
        ], $query->build());
    }
}
