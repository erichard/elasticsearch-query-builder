<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\CardinalityAggregation;
use Erichard\ElasticQueryBuilder\Options\SourceScript;
use PHPUnit\Framework\TestCase;

class CardinalityAggregationTest extends TestCase
{
    public function testItBuildTheAggregationUsingAField(): void
    {
        $query = new CardinalityAggregation('city');

        $this->assertEquals([
            'cardinality' => [
                'field' => 'city',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAFieldViaSet(): void
    {
        $query = new CardinalityAggregation('city');
        $query->setScript('test2');
        $query->setField('test');

        $this->assertEquals([
            'cardinality' => [
                'field' => 'test',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAScriptViaSet(): void
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

    public function testItBuildTheAggregationUsingAScript(): void
    {
        $query = new CardinalityAggregation('city', new SourceScript('asd'));

        $this->assertEquals([
            'cardinality' => [
                'script' => [
                    'source' => 'asd',
                ],
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationUsingAFieldAndDifferentName(): void
    {
        $query = new CardinalityAggregation('city', 'test');

        $this->assertEquals([
            'cardinality' => [
                'field' => 'test',
            ],
        ], $query->build());
    }

    public function testItBuildTheAggregationWithMissingValue(): void
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

    public function testItBuildTheAggregationWithAPrecisionThreshold(): void
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
