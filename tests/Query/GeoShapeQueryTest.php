<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\GeoShapeQuery;
use PHPUnit\Framework\TestCase;

class GeoShapeQueryTest extends TestCase
{
    public function testItBuildsTheQuery(): void
    {
        $query = new GeoShapeQuery('coordinates', 'polygon', [[-70, 40]]);

        $query->setRelation('outside');

        $this->assertEquals([
            'geo_shape' => [
                'coordinates' => [
                    'shape' => [
                        'type' => 'polygon',
                        'coordinates' => [[-70, 40]],
                    ],
                    'relation' => 'outside',
                ],
            ],
        ], $query->build());
    }
}
