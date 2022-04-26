<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Entities\GpsPointEntity;
use Erichard\ElasticQueryBuilder\Features\HasField;
use Exception;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-geo-bounding-box-query.html
 */
class GeoBoundingBoxQuery implements QueryInterface
{
    use HasField;

    public function __construct(
        string $field,
        private GpsPointEntity|null $topLeft = null,
        private GpsPointEntity|null $bottomRight = null,
        private GpsPointEntity|null $topRight = null,
        private GpsPointEntity|null $bottomLeft = null,
    ) {
        $this->field = $field;
    }

    public function build(): array
    {
        $filters = array_filter([
            'top_left' => $this->pointToArray($this->topLeft),
            'bottom_right' => $this->pointToArray($this->bottomRight),
            'top_right' => $this->pointToArray($this->topRight),
            'bottom_left' => $this->pointToArray($this->bottomLeft),
        ]);

        if (count($filters) < 2) {
            throw new Exception('GeoBoundingBoxQuery needs at least 2 sides set');
        }

        return [
            'geo_bounding_box' => [
                $this->field => $filters,
            ],
        ];
    }

    protected function pointToArray(?GpsPointEntity $entity): ?array
    {
        if (null === $entity) {
            return null;
        }

        return [
            'lat' => $entity->lat,
            'lon' => $entity->lon,
        ];
    }
}
