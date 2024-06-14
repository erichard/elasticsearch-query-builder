<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder;

use Erichard\ElasticQueryBuilder\QueryBuilder;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{
    public function testItDisableTheSource(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setSource(false);

        $query = $queryBuilder->build();

        $this->assertFalse($query['_source']);
    }

    public function testItSetTheSource(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setSource('obj.*');

        $query = $queryBuilder->build();

        $this->assertEquals('obj.*', $query['_source']);
    }

    public function testItSetTheIndex(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setIndex('index1');

        $query = $queryBuilder->build();

        $this->assertEquals('index1', $query['index']);
    }

    public function testItSetTheSize(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setSize(50);

        $query = $queryBuilder->build();

        $this->assertEquals(50, $query['size']);
    }

    public function testItSetTheFrom(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setFrom(50);

        $query = $queryBuilder->build();

        $this->assertEquals(50, $query['from']);
    }

    public function testItSetThePitAsString(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setPit('pit-as-string');

        $query = $queryBuilder->build();

        $this->assertEquals(['id' => 'pit-as-string'], $query['body']['pit']);
    }

    public function testItSetThePitAsArray(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setPit(['id' => 'pit-as-array', 'keep_alive' => '1m']);

        $query = $queryBuilder->build();

        $this->assertEquals(['id' => 'pit-as-array', 'keep_alive' => '1m'], $query['body']['pit']);
    }

    public function testItAllowToSort(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->addSort('field', [
            'order' => 'desc',
        ]);
        $queryBuilder->addSort('field2', [
            'order' => 'asc',
        ]);

        $query = $queryBuilder->build();

        $this->assertEquals([
            'field' => [
                'order' => 'desc',
            ],
            'field2' => [
                'order' => 'asc',
            ],
        ], $query['body']['sort']);
    }
}
