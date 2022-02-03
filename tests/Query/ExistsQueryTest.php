<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\ExistsQuery;
use PHPUnit\Framework\TestCase;

class ExistsQueryTest extends TestCase
{
    public function test_it_build_the_query_with_a_constructor()
    {
        $query = new ExistsQuery('someFieldName');

        $this->assertEquals([
            'exists' => [
                'field' => 'someFieldName',
            ],
        ], $query->build());
    }
    
}
