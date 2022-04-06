<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Aggregation\RangesAggregation;
use PHPUnit\Framework\TestCase;

class RangesAggregationTest extends TestCase
{
    public function testGetBeachDistancesRangesAggregation(): void
    {
        $instance = new RangesAggregation(
            'beach',
            'option_236',
            [10, 50, 100, 200, 350, 500, 750, 1000, 1500, 2500],
        );

        $expected = [
            'range' => [
                'field' => 'option_236',
                'ranges' => [
                    0 => [
                        'from' => 0,
                        'to' => 10,
                        'key' => 10,
                    ],
                    1 => [
                        'from' => 10,
                        'to' => 50,
                        'key' => 50,
                    ],
                    2 => [
                        'from' => 50,
                        'to' => 100,
                        'key' => 100,
                    ],
                    3 => [
                        'from' => 100,
                        'to' => 200,
                        'key' => 200,
                    ],
                    4 => [
                        'from' => 200,
                        'to' => 350,
                        'key' => 350,
                    ],
                    5 => [
                        'from' => 350,
                        'to' => 500,
                        'key' => 500,
                    ],
                    6 => [
                        'from' => 500,
                        'to' => 750,
                        'key' => 750,
                    ],
                    7 => [
                        'from' => 750,
                        'to' => 1000,
                        'key' => 1000,
                    ],
                    8 => [
                        'from' => 1000,
                        'to' => 1500,
                        'key' => 1500,
                    ],
                    9 => [
                        'from' => 1500,
                        'to' => 2500,
                        'key' => 2500,
                    ],
                    10 => [
                        'key' => '2500-*',
                        'from' => 2500,
                    ],
                ],
            ],
        ];
        $built = $instance->build();
        $this->assertEquals($expected, $built);
    }

    public function testGetBeachDistancesRangesAggregationWithEqualRanges(): void
    {
        $instance = new RangesAggregation(
            'beach',
            'option_236',
            [10, 50, 100, 200, 350, 500, 750, 1000, 1500, 2500],
            [],
            true
        );

        $expected = [
            'range' => [
                'field' => 'option_236',
                'ranges' => [
                    0 => [
                        'from' => 0,
                        'to' => 11,
                        'key' => 10,
                    ],
                    1 => [
                        'from' => 10,
                        'to' => 51,
                        'key' => 50,
                    ],
                    2 => [
                        'from' => 50,
                        'to' => 101,
                        'key' => 100,
                    ],
                    3 => [
                        'from' => 100,
                        'to' => 201,
                        'key' => 200,
                    ],
                    4 => [
                        'from' => 200,
                        'to' => 351,
                        'key' => 350,
                    ],
                    5 => [
                        'from' => 350,
                        'to' => 501,
                        'key' => 500,
                    ],
                    6 => [
                        'from' => 500,
                        'to' => 751,
                        'key' => 750,
                    ],
                    7 => [
                        'from' => 750,
                        'to' => 1001,
                        'key' => 1000,
                    ],
                    8 => [
                        'from' => 1000,
                        'to' => 1501,
                        'key' => 1500,
                    ],
                    9 => [
                        'from' => 1500,
                        'to' => 2501,
                        'key' => 2500,
                    ],
                    10 => [
                        'key' => '2500-*',
                        'from' => 2500,
                    ],
                ],
            ],
        ];
        $built = $instance->build();
        $this->assertEquals($expected, $built);
    }
}
