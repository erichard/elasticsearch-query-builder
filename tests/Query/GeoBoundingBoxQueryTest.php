<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Entities\GpsPointEntity;
use Erichard\ElasticQueryBuilder\Query\GeoBoundingBoxQuery;
use PHPUnit\Framework\TestCase;

class GeoBoundingBoxQueryTest extends TestCase
{
    public function testBuildFailsOnAllNull(): void
    {
        $this->expectErrorMessage('GeoBoundingBoxQuery needs at least 2 sides set');
        (new GeoBoundingBoxQuery('test'))->build();
    }

    public function testBuildFailsOnOneFilter(): void
    {
        $this->expectErrorMessage('GeoBoundingBoxQuery needs at least 2 sides set');
        (new GeoBoundingBoxQuery(field: 'test', topLeft: new GpsPointEntity(1.1, 2.1)))->build();
    }

    public function testBuildTopLeftBottomRight(): void
    {
        $result = (new GeoBoundingBoxQuery(
            field: 'test',
            topLeft: new GpsPointEntity(1.1, 2.1),
            bottomRight: new GpsPointEntity(2.1, 3.1),
        ))->build();

        $this->assertEquals([
            'geo_bounding_box' => [
                'test' => [
                    'top_left' => [
                        'lat' => 1.1,
                        'lon' => 2.1,
                    ],
                    'bottom_right' => [
                        'lat' => 2.1,
                        'lon' => 3.1,
                        
                    ],
                    
                ],
            ],
        ], $result);
    }

    public function testBuildTopRightBottomLeft(): void
    {
        $result = (new GeoBoundingBoxQuery(
            field: 'test',
            topRight: new GpsPointEntity(1.1, 2.1),
            bottomLeft: new GpsPointEntity(2.1, 3.1),
        ))->build();

        $this->assertEquals([
            'geo_bounding_box' => [
                'test' => [
                    'top_right' => [
                        'lat' => 1.1,
                        'lon' => 2.1,
                    ],
                    'bottom_left' => [
                        'lat' => 2.1,
                        'lon' => 3.1,
                        
                    ],
                    
                ],
            ],
        ], $result);
    }
}
