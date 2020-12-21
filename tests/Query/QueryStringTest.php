<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;
use Erichard\ElasticQueryBuilder\Query\Query;
use Erichard\ElasticQueryBuilder\Query\QueryStringQuery;
use PHPUnit\Framework\TestCase;

class QueryStringTest extends TestCase
{
    public function test_it_build_the_query()
    {
        $queryStringQuery = new QueryStringQuery('brown fox');

        $query = $queryStringQuery->build();

        $this->assertEquals([
            'query_string' => [
                'query' => 'brown fox',
            ]
        ], $query);
    }

    public function test_it_build_the_query_with_default_field()
    {
        $queryStringQuery = new QueryStringQuery('brown fox', 'description');

        $query = $queryStringQuery->build();

        $this->assertEquals([
            'query_string' => [
                'query' => 'brown fox',
                'default_field' => 'description',
            ]
        ], $query);
    }
}
