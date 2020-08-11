<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\ExistsQuery;
use Erichard\ElasticQueryBuilder\QueryException;
use Erichard\ElasticQueryBuilder\Query\TermsQuery;
use PHPUnit\Framework\TestCase;

class ExistsQueryTest extends TestCase
{
    public function test_it_build_the_query_with_a_constructor()
    {
        $query = new ExistsQuery('someFieldName');

        $this->assertEquals([
            'exists' => [
                'field' => 'someFieldName',
            ],
        ], $query->build());
    }

    public function test_it_cannot_be_built_empty()
    {
        $query = new TermsQuery();

        $this->expectException(QueryException::class);

        $query->build();
    }
}
