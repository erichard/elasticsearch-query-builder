<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\BoolQuery;
use Erichard\ElasticQueryBuilder\Query\Query;
use Erichard\ElasticQueryBuilder\QueryException;
use PHPUnit\Framework\TestCase;

class BoolQueryTest extends TestCase
{
    public function testItCannotBeBuiltEmpty(): void
    {
        $boolQuery = new BoolQuery();

        $this->expectException(QueryException::class);

        $boolQuery->build();
    }

    public function testAddFilterWithSameObject(): void
    {
        $this->expectExceptionMessage('You are trying to add self to a bool query');
        $boolQuery = new BoolQuery();

        $boolQuery->addFilter($boolQuery);
        $boolQuery->build();
    }

    public function testAddShouldWithSameObject(): void
    {
        $this->expectExceptionMessage('You are trying to add self to a bool query');
        $boolQuery = new BoolQuery();

        $boolQuery->addShould($boolQuery);
        $boolQuery->build();
    }

    public function testAddMustNotWithSameObject(): void
    {
        $this->expectExceptionMessage('You are trying to add self to a bool query');
        $boolQuery = new BoolQuery();

        $boolQuery->addMustNot($boolQuery);
        $boolQuery->build();
    }

    public function testAddMustWithSameObject(): void
    {
        $this->expectExceptionMessage('You are trying to add self to a bool query');
        $boolQuery = new BoolQuery();

        $boolQuery->addMust($boolQuery);
        $boolQuery->build();
    }

    public function testItAddAMustClause(): void
    {
        $boolQuery = new BoolQuery();

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

    public function testItAddAMustNotClause(): void
    {
        $boolQuery = new BoolQuery();

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

    public function testItAddAShouldClause(): void
    {
        $boolQuery = new BoolQuery();

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

    public function testItAddAFilterClause(): void
    {
        $boolQuery = new BoolQuery();

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
