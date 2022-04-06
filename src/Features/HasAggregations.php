<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

use Erichard\ElasticQueryBuilder\Aggregation\AbstractAggregation;

trait HasAggregations
{
    /**
     * @var array<AbstractAggregation>
     */
    private array $aggregations = [];

    public function addAggregation(AbstractAggregation $aggregation): self
    {
        $this->aggregations[] = $aggregation;

        return $this;
    }

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public function setAggregations(array $aggregations): self
    {
        $this->aggregations = $aggregations;

        return $this;
    }

    /**
     * @return array<AbstractAggregation>|null
     */
    public function getAggregations(): ?array
    {
        return $this->aggregations;
    }

    protected function buildAggregationsTo(array &$toArray): self
    {
        if (count($this->aggregations) === 0) {
            return $this;
        }

        $aggregations = [];
        foreach ($this->aggregations as $aggregation) {
            $aggregations[$aggregation->getName()] = $aggregation->build();
        }

        $toArray['aggs'] = $aggregations;

        return $this;
    }
}
