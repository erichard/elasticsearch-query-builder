<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\MatchQuery;
use Erichard\ElasticQueryBuilder\Query\PrefixQuery;
use PHPUnit\Framework\TestCase;

class PrefixQueryTest extends TestCase
{
    public function testItBuildTheQuery(): void
    {
        $query = new PrefixQuery('title', 'a brown fox', null, true);

        $this->assertEquals([
            'prefix' => [
                'title' => [
                    'value' => 'a brown fox',
                    'case_insensitive' => true,
                ],
            ],
        ], $query->build());
    }
}
