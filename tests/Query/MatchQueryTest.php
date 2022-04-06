<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\MatchQuery;
use PHPUnit\Framework\TestCase;

class MatchQueryTest extends TestCase
{
    public function testItBuildTheQuery(): void
    {
        $query = new MatchQuery('title', 'a brown fox');

        $this->assertEquals([
            'match' => [
                'title' => [
                    'query' => 'a brown fox',
                ],
            ],
        ], $query->build());
    }

    public function testItBuildTheQueryWithAnAnalyzer(): void
    {
        $query = new MatchQuery('title', 'a brown fox');
        $query->setAnalyzer('custom_analyzer');

        $this->assertEquals([
            'match' => [
                'title' => [
                    'query' => 'a brown fox',
                    'analyzer' => 'custom_analyzer',
                ],
            ],
        ], $query->build());
    }
}
