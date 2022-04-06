<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\ExistsQuery;
use PHPUnit\Framework\TestCase;

class ExistsQueryTest extends TestCase
{
    public function testItBuildTheQueryWithAConstructor(): void
    {
        $query = new ExistsQuery('someFieldName');

        $this->assertEquals([
            'exists' => [
                'field' => 'someFieldName',
            ],
        ], $query->build());
    }
}
