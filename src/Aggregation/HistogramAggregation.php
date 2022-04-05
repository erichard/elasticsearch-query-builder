<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Features\HasField;

class HistogramAggregation extends AbstractAggregation
{
    use HasField;

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public function __construct(
        string $name,
        string $field,
        private int $interval,
        array $aggregations = []
    ) {
        parent::__construct($name, $aggregations);
        $this->field = $field;
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
        return [
            'field' => $this->field,
            'interval' => $this->interval,
        ];
    }
}
