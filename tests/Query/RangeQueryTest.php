<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\RangeQuery;
use PHPUnit\Framework\TestCase;

class RangeQueryTest extends TestCase
{
    public function testItBuildTheQuery(): void
    {
        $query = new RangeQuery('points', 50, 10, null, null, null, 0.8);

        $this->assertEquals([
            'range' => [
                'points' => [
                    'gt' => 10,
                    'lt' => 50,
                    'boost' => 0.8,
                ],
            ],
        ], $query->build());
    }
}
