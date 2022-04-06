<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\QueryStringQuery;
use PHPUnit\Framework\TestCase;

class QueryStringTest extends TestCase
{
    public function testItBuildTheQuery(): void
    {
        $queryStringQuery = new QueryStringQuery('brown fox');

        $queryStringQuery->setDefaultField('test');

        $this->assertEquals([
            'query_string' => [
                'query' => 'brown fox',
                'default_field' => 'test',
            ],
        ], $queryStringQuery->build());
    }
}
