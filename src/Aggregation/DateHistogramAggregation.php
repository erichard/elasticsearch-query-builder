<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Features\HasExtendedBounds;
use Erichard\ElasticQueryBuilder\Features\HasField;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-bucket-datehistogram-aggregation.html
 */
class DateHistogramAggregation extends AbstractAggregation
{
    use HasField;
    use HasExtendedBounds; // TODO enum

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public function __construct(
        string $nameAndField,
        private string $calendarInterval,
        ?string $field = null,
        array $aggregations = [],
        ?string $min = null,
        ?string $max = null,
    ) {
        parent::__construct($nameAndField, $aggregations);
        $this->field = $field ?? $nameAndField;
        $this->min = $min;
        $this->max = $max;
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
        $build = [
            'field' => $this->field,
            'calendar_interval' => $this->calendarInterval,
        ];

        if (null !== $this->min && null !== $this->max) {
            $build['extended_bounds']['min'] = $this->min;
            $build['extended_bounds']['max'] = $this->max;
        }

        return $build;
    }
}
