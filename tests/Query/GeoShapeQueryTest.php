<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\GeoShapeQuery;
use PHPUnit\Framework\TestCase;

class GeoShapeQueryTest extends TestCase
{
    public function test_it_builds_the_query()
    {
        $query = new GeoShapeQuery(
            'coordinates', 'polygon', [[-70, 40]]
        );

        $this->assertEquals([
            'geo_shape' => [
                'coordinates' => [
                    'shape' => [
                        'type' => 'polygon',
                        'coordinates' => [[-70, 40]]
                    ],
                    'relation' => 'within'
                ]
            ]
        ], $query->build());
    }

    public function test_it_builds_the_query_from_setters()
    {
        $query = new GeoShapeQuery();

        $query->setType('polygon')
            ->setCoordinates([[-70, 40]])
            ->setField('coordinates')
            ->setRelation('within');

        $this->assertEquals([
            'geo_shape' => [
                'coordinates' => [
                    'shape' => [
                        'type' => 'polygon',
                        'coordinates' => [[-70, 40]]
                    ],
                    'relation' => 'within'
                ]
            ]
        ], $query->build());
    }
}