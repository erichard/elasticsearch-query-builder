<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\BoolQuery;
use Erichard\ElasticQueryBuilder\Query\Query;
use Erichard\ElasticQueryBuilder\QueryException;
use PHPUnit\Framework\TestCase;

class BoolQueryTest extends TestCase
{
    public function test_it_cannot_be_built_empty()
    {
        $boolQuery = new BoolQuery('empty_query');

        $this->expectException(QueryException::class);

        $boolQuery->build();
    }

    public function test_it_add_a_must_clause()
    {
        $boolQuery = new BoolQuery('must_clause');

        $boolQuery->addMust(Query::term('field', 'value'));
        $query = $boolQuery->build();

        $this->assertEquals([
            'bool' => [
                'must' => [
                    [
                        'term' => [
                            'field' => 'value',
                        ],
                    ],
                ],
            ],
        ], $query);
    }

    public function test_it_add_a_must_not_clause()
    {
        $boolQuery = new BoolQuery('must_clause');

        $boolQuery->addMustNot(Query::term('field', 'value'));
        $query = $boolQuery->build();

        $this->assertEquals([
            'bool' => [
                'must_not' => [
                    [
                        'term' => [
                            'field' => 'value',
                        ],
                    ],
                ],
            ],
        ], $query);
    }

    public function test_it_add_a_should_clause()
    {
        $boolQuery = new BoolQuery('must_clause');

        $boolQuery->addShould(Query::term('field', 'value'));
        $query = $boolQuery->build();

        $this->assertEquals([
            'bool' => [
                'should' => [
                    [
                        'term' => [
                            'field' => 'value',
                        ],
                    ],
                ],
            ],
        ], $query);
    }

    public function test_it_add_a_filter_clause()
    {
        $boolQuery = new BoolQuery('must_clause');

        $boolQuery->addFilter(Query::term('field', 'value'));
        $query = $boolQuery->build();

        $this->assertEquals([
            'bool' => [
                'filter' => [
                    [
                        'term' => [
                            'field' => 'value',
                        ],
                    ],
                ],
            ],
        ], $query);
    }
}
