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
}
