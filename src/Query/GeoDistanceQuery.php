<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasField;

class GeoDistanceQuery implements QueryInterface
{
    use HasField;

    /**
     * @param float[]|int[] $position
     */
    public function __construct(
        private string $distance,
        string $field,
        private array $position
    ) {
        $this->field = $field;
    }

    public function setDistance(string $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function setPosition(array $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function build(): array
    {
        return [
            'geo_distance' => [
                'distance' => $this->distance,
                $this->field => [
                    'lat' => $this->position[0],
                    'lon' => $this->position[1],
                ],
            ],
        ];
    }
}
