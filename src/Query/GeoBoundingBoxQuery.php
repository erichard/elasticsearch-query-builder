<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Entities\GpsPointEntity;
use Erichard\ElasticQueryBuilder\Features\HasField;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-geo-bounding-box-query.html
 */
class GeoBoundingBoxQuery implements QueryInterface
{
    use HasField;

    public function __construct(
        string $field,
        private GpsPointEntity $topLeft,
        private GpsPointEntity $bottomRight
    ) {
        $this->field = $field;
    }

    public function build(): array
    {
        return [
            'geo_bounding_box' => [
                $this->field => [
                    'top_left' => $this->pointToArray($this->topLeft),
                    'bottom_right' => $this->pointToArray($this->bottomRight),
                ],
            ],
        ];
    }

    protected function pointToArray(GpsPointEntity $entity): array
    {
        return [
            'lat' => $entity->lat,
            'lon' => $entity->lon,
        ];
    }
}
