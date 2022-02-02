<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;
use Erichard\ElasticQueryBuilder\Query\GeoDistanceQuery;
use Erichard\ElasticQueryBuilder\Query\TermsQuery;
use PHPUnit\Framework\TestCase;

class TermsQueryTest extends TestCase
{
    public function test_it_build_the_query_with_a_constructor()
    {
        $query = new TermsQuery('field', ['value1', 'value2']);

        $this->assertEquals([
            'terms' => [
                'field' => ['value1', 'value2'],
            ],
        ], $query->build());
    }

    public function test_it_cannot_be_built_empty()
    {
        $query = new TermsQuery();

        $this->expectException(QueryException::class);

        $query->build();
    }

    public function test_it_builds_the_query_from_setters()
    {
        $query = new TermsQuery();

        $query->setField('field')
            ->setValues(['value1', 'value2']);

        $this->assertEquals([
            'terms' => [
                'field' => ['value1', 'value2'],
            ],
        ], $query->build());
    }
}
