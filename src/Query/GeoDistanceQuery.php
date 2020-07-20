<?php

namespace Erichard\ElasticQueryBuilder\Query;

class GeoDistanceQuery implements QueryInterface
{
    /** @var string */
    private $distance;

    /** @var array|float[]|int[] */
    private $position;

    /** @var string */
    private $field;

    public function __construct(string $distance, string $field, array $position)
    {
        $this->distance = $distance;
        $this->field = $field;
        $this->position = $position;
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

    public function setField(string $field)
    {
        $this->field = $field;

        return $this;
    }

    public function build(): array
    {
        if (empty($this->distance)) {
            throw new QueryException('You should call GeoDistanceQuery::setDistance() before building this query');
        }

        if (empty($this->field)) {
            throw new QueryException('You should call GeoDistanceQuery::setField() before building this query');
        }

        if (empty($this->position)) {
            throw new QueryException('You should call GeoDistanceQuery::setPosition() before building this query');
        }

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
