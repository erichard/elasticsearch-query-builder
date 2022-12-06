<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\FunctionsQuery;
use PHPUnit\Framework\TestCase;

class FunctionsQueryTest extends TestCase
{
    public function testFunctionsQuery(): void
    {
        $functionsQuery = new FunctionsQuery('column1');

        $response = [
            'filter' => [
                'term' => [
                    '_index' => 'column1',
                ],
            ],
        ];

        $this->assertEquals($response, $functionsQuery->build());
    }

    public function testFunctionsQuerySetWeight(): void
    {
        $functionsQuery = new FunctionsQuery('column1');
        $functionsQuery->setWeight(2.50);

        $response = [
            'filter' => [
                'term' => [
                    '_index' => 'column1',
                ],
            ],
            'weight' => 2.50,
        ];

        $this->assertEquals($response, $functionsQuery->build());
    }
}
