<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\GeoDistanceQuery;
use PHPUnit\Framework\TestCase;

class GeoDistanceQueryTest extends TestCase
{
    public function testItBuildTheQuery(): void
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
