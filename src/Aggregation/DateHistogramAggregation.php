<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Features\HasField;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-bucket-datehistogram-aggregation.html
 */
class DateHistogramAggregation extends AbstractAggregation
{
    use HasField; // TODO enum

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public function __construct(
        string $nameAndField,
        private string $calendarInterval,
        ?string $field = null,
        array $aggregations = []
    ) {
        parent::__construct($nameAndField, $aggregations);
        $this->field = $field ?? $nameAndField;
    }

    public function setCalendarInterval(string $calendarInterval): self
    {
        $this->calendarInterval = $calendarInterval;

        return $this;
    }

    public function getCalendarInterval(): string
    {
        return $this->calendarInterval;
    }

    protected function getType(): string
    {
        return 'date_histogram';
    }

    protected function buildAggregation(): array
    {
        return [
            'field' => $this->field,
            'calendar_interval' => $this->calendarInterval,
        ];
    }
}
