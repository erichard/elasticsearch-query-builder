<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use PHPUnit\Framework\TestCase;

class FunctionScoreQueryTest extends TestCase
{
    public function testBuildFunctionScoreQuery(): void
    {
        $fields = ['column1', 'column2'];
        $query = '(*name*) OR name';

        $functionScoreQuery = new FunctionScoreQuery($fields, $query);

        $response = [
            'function_score' => [
                'query' => [
                    'query_string' => [
                        'query' => '(*name*) OR name',
                        'fields' => ['column1', 'column2'],
                    ],
                ],
            ],
        ];

        $this->assertEquals($response, $functionScoreQuery->build());
    }

    public function testBuildFunctionScoreQuerySetParams(): void
    {
        $fields = ['column1', 'column2'];
        $query = '(*name*) OR name';

        $functionScoreQuery = new FunctionScoreQuery($fields, $query);
        $functionScoreQuery->setBoostMode('multiply');
        $functionScoreQuery->setFunctions($this->functions());

        $response = [
            'function_score' => [
                'boost_mode' => 'multiply',
                'functions' => [
                    'filter' => [
                        'term' => [
                            '_index' => 'column2',
                        ],
                    ],
                    'weight' => 2.50,
                ],
                'query' => [
                    'query_string' => [
                        'query' => '(*name*) OR name',
                        'fields' => ['column1', 'column2'],
                    ],
                ],
            ],
        ];

        $this->assertEquals($response, $functionScoreQuery->build());
    }

    private function functions(): array
    {
        $functions = new FunctionsQuery('column2');
        $functions->setWeight(2.50);

        return $functions->build();
    }
}
