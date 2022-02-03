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

        $queryStringQuery->setDefaultField('test');

        $this->assertEquals([
            'query_string' => [
                'query' => 'brown fox',
                'default_field' => 'test',
            ]
        ], $queryStringQuery->build());
    }
}
