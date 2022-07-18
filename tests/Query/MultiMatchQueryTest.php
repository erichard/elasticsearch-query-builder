<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\MultiMatchQuery;
use PHPUnit\Framework\TestCase;

class MultiMatchQueryTest extends TestCase
{
    public function testItBuildTheQuery(): void
    {
        $query = new MultiMatchQuery(['subject', 'body'], 'a brown fox', 'cross_fields', null, 'AND');

        $this->assertEquals([
            'multi_match' => [
                'fields' => ['subject', 'body'],
                'query' => 'a brown fox',
                'type' => 'cross_fields',
                'operator' => 'AND',
            ],
        ], $query->build());
    }

    public function testItBuildTheQueryWithAFuzziness(): void
    {
        $query = new MultiMatchQuery(['subject', 'body'], 'a brown fox');
        $query->setFuzziness('AUTO');

        $this->assertEquals([
            'multi_match' => [
                'fields' => ['subject', 'body'],
                'query' => 'a brown fox',
                'fuzziness' => 'AUTO',
            ],
        ], $query->build());
    }
}
