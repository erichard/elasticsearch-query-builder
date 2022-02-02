<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\GeoDistanceQuery;
use PHPUnit\Framework\TestCase;

class GeoDistanceQueryTest extends TestCase
{
    public function test_it_build_the_query()
    {
        $query = new GeoDistanceQuery('200km', 'geolocation', [40, -70]);

        $this->assertEquals([
            'geo_distance' => [
                'distance' => '200km',
                'geolocation' => [
                    'lat' => 40,
                    'lon' => -70,
                ],
            ],
        ], $query->build());
    }

    public function test_it_builds_the_query_from_setters()
    {
        $query = new GeoDistanceQuery();

        $query->setDistance('200km')
            ->setPosition([40, -70])
            ->setField('geolocation');

        $this->assertEquals([
            'geo_distance' => [
                'distance' => '200km',
                'geolocation' => [
                    'lat' => 40,
                    'lon' => -70,
                ],
            ],
        ], $query->build());
    }
}
