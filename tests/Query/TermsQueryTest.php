<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\TermsQuery;
use PHPUnit\Framework\TestCase;

class TermsQueryTest extends TestCase
{
    public function testItBuildTheQueryWithAConstructor(): void
    {
        $query = new TermsQuery('field', ['value1', 'value2'], 1.4);

        $this->assertEquals([
            'terms' => [
                'field' => ['value1', 'value2'],
                'boost' => 1.4,
            ],
        ], $query->build());
    }
}
