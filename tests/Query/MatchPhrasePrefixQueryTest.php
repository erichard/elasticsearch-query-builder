<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\MatchPhrasePrefixQuery;
use PHPUnit\Framework\TestCase;

class MatchPhrasePrefixQueryTest extends TestCase
{
    public function test_it_build_the_query()
    {
        $query = new MatchPhrasePrefixQuery('title', 'a brown fox');

        $this->assertEquals([
            'match_phrase_prefix' => [
                'title' => [
                    'query' => 'a brown fox',
                ],
            ],
        ], $query->build());
    }

    public function test_it_build_the_query_with_an_analyzer()
    {
        $query = new MatchPhrasePrefixQuery('title', 'a brown fox');
        $query->setAnalyzer('custom_analyzer');

        $this->assertEquals([
            'match_phrase_prefix' => [
                'title' => [
                    'query' => 'a brown fox',
                    'analyzer' => 'custom_analyzer',
                ],
            ],
        ], $query->build());
    }

    public function test_it_builds_the_query_from_setters()
    {
        $query = new MatchPhrasePrefixQuery();

        $query->setField('title')
            ->setQuery('a brown fox');

        $this->assertEquals([
            'match_phrase_prefix' => [
                'title' => [
                    'query' => 'a brown fox'
                ],
            ],
        ], $query->build());
    }
}
