<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\GeoShapeQuery;
use PHPUnit\Framework\TestCase;

class GeoShapeQueryTest extends TestCase
{
    public function test_it_builds_the_query()
    {
        $query = new GeoShapeQuery(
            'polygon', 'coordinates', [[-70, 40]], 'test'
        );

        $this->assertEquals([
            'geo_shape' => [
                'coordinates' => [
                    'shape' => [
                        'type' => 'polygon',
                        'coordinates' => [[-70, 40]]
                    ],
                    'relation' => 'test'
                ]
            ]
        ], $query->build());
    }
}