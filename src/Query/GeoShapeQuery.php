<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\QueryInterface;

class GeoShapeQuery implements QueryInterface
{
    /** @var string */
    private $type;

    /** @var array|int[]|float[] */
    private $coordinates;

    /** @var string */
    private $field;

    /** @var string */
    private $relation = 'within';

    public function __construct(string $field, string $type, array $coordinates)
    {
        $this->field = $field;
        $this->type = $type;
        $this->coordinates = $coordinates;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setCoordinates(array $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function setRelation(string $relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    public function build(): array
    {
        return [
            'geo_shape' => [
                $this->field => [
                    'shape' => [
                        'type' => $this->type,
                        'coordinates' => $this->coordinates
                    ],
                    'relation' => $this->relation
                ]
            ]
        ];
    }
}