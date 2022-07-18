<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\QueryStringQuery;
use PHPUnit\Framework\TestCase;

class QueryStringQueryTest extends TestCase
{
    public function testItBuildTheQuery(): void
    {
        $queryStringQuery = new QueryStringQuery('brown fox', 'test', 'AND', null, 1.1, '10%');

        $this->assertEquals([
            'query_string' => [
                'query' => 'brown fox',
                'default_field' => 'test',
                'default_operator' => 'AND',
                'boost' => 1.1,
                'minimum_should_match' => '10%',
            ],
        ], $queryStringQuery->build());
    }
}
