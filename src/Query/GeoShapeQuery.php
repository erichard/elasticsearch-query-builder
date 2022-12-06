<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;

class GeoShapeQuery implements QueryInterface
{
    private string $relation = 'within';

    /**
     * @param mixed[]|float[]|int[] $coordinates
     */
    public function __construct(
        private string $field,
        private string $type,
        private array $coordinates,
        private array $params = [],
    ) {}

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

    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    public function build(): array
    {
        $build = $this->params;
        $build['geo_shape'] = [
            $this->field => [
                'shape' => [
                    'type' => $this->type,
                    'coordinates' => $this->coordinates,
                ],
                'relation' => $this->relation,
            ],
        ];

        return $build;
    }
}
