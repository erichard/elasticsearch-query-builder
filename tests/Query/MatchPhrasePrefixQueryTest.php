<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\MatchPhrasePrefixQuery;
use PHPUnit\Framework\TestCase;

class MatchPhrasePrefixQueryTest extends TestCase
{
    public function testItBuildTheQuery(): void
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

    public function testItBuildTheQueryWithAnAnalyzer(): void
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
}
