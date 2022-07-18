<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\TermQuery;
use PHPUnit\Framework\TestCase;

class TermQueryTest extends TestCase
{
    public function testItBuildTheQuery(): void
    {
        $query = new TermQuery('title', 'a brown fox', 1.1, true);

        $this->assertEquals([
            'term' => [
                'title' => [
                    'value' => 'a brown fox',
                    'boost' => 1.1,
                    'case_insensitive' => true,
                ],
            ],
        ], $query->build());
    }
}
