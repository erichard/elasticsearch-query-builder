<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

/**
 * @see  https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-bucket-histogram-aggregation.html#search-aggregations-bucket-histogram-aggregation-extended-bounds
 */
trait HasExtendedBounds
{
    protected ?string $min;

    protected ?string $max;

    public function setMin(?string $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMin(): ?string
    {
        return $this->min;
    }

    public function setMax(?string $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function getMax(): ?string
    {
        return $this->max;
    }
}
