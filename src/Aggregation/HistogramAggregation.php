<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Features\HasExtendedBounds;
use Erichard\ElasticQueryBuilder\Features\HasField;

class HistogramAggregation extends AbstractAggregation
{
    use HasField;
    use HasExtendedBounds;

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public function __construct(
        string $name,
        string $field,
        private int $interval,
        array $aggregations = [],
        ?string $min = null,
        ?string $max = null,
    ) {
        parent::__construct($name, $aggregations);
        $this->field = $field;
        $this->min = $min;
        $this->max = $max;
    }

    public function getInterval(): int
    {
        return $this->interval;
    }

    public function setInterval(int $interval): void
    {
        $this->interval = $interval;
    }

    protected function getType(): string
    {
        return 'histogram';
    }

    protected function buildAggregation(): array
    {
        $build = [
            'field' => $this->field,
            'interval' => $this->interval,
        ];

        if (null !== $this->min && null !== $this->max) {
            $build['extended_bounds']['min'] = $this->min;
            $build['extended_bounds']['max'] = $this->max;
        }

        return $build;
    }
}
