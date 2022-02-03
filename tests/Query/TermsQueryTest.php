<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

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
}
