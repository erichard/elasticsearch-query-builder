<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Contracts\BuildsArray;
use Erichard\ElasticQueryBuilder\Features\HasAggregations;

abstract class AbstractAggregation implements BuildsArray
{
    use HasAggregations;

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public function __construct(
        private string $name,
        array $aggregations = [],
    ) {
        $this->aggregations = $aggregations;
    }

    /**
     * @return array<string, array>|array<string, string>|array<string, int>
     */
    public function build(): array
    {
        $build = $this->buildAggregation();

        if ([] === $build) {
            $build = new \stdClass();
        }

        $data = [
            $this->getType() => $build,
        ];

        $this->buildAggregationsTo($data);

        return $data;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract protected function getType(): string;

    abstract protected function buildAggregation(): array;
}
