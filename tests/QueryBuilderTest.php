<?php

namespace Tests\Erichard\ElasticQueryBuilder;

use Erichard\ElasticQueryBuilder\QueryBuilder;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{
    public function test_it_disable_the_source()
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setSource(false);

        $query = $queryBuilder->build();

        $this->assertFalse($query['_source']);
    }

    public function test_it_set_the_source()
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setSource('obj.*');

        $query = $queryBuilder->build();

        $this->assertEquals('obj.*', $query['_source']);
    }

    public function test_it_set_the_index()
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setIndex('index1');

        $query = $queryBuilder->build();

        $this->assertEquals('index1', $query['index']);
    }

    public function test_it_set_the_size()
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setSize(50);

        $query = $queryBuilder->build();

        $this->assertEquals(50, $query['size']);
    }

    public function test_it_set_the_from()
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->setFrom(50);

        $query = $queryBuilder->build();

        $this->assertEquals(50, $query['from']);
    }

    public function test_it_allow_to_sort()
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->addSort('field', ['order' => 'desc']);
        $queryBuilder->addSort('field2', ['order' => 'asc']);

        $query = $queryBuilder->build();

        $this->assertEquals([
            'field' => ['order' => 'desc'],
            'field2' => ['order' => 'asc'],
        ], $query['body']['sort']);
    }
}
