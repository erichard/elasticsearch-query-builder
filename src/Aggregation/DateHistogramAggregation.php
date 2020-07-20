<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Filter\Filter;
use Erichard\ElasticQueryBuilder\QueryException;

class DateHistogramAggregation extends Aggregation
{
    /** @var string */
    private $field;

    /** @var string */
    private $calendarInterval;

    public function setField(string $field)
    {
        $this->field = $field;

        return $this;
    }

    public function setCalendarInterval(string $calendarInterval)
    {
        $this->calendarInterval = $calendarInterval;

        return $this;
    }

    public function build(): array
    {
        if (null === $this->field) {
            throw new QueryException('You should call DateHistogramAggregation::setField() before build.');
        }

        if (null === $this->calendarInterval) {
            throw new QueryException('You should call DateHistogramAggregation::calendarInterval() before build.');
        }

        return [
            'date_histogram' => [
                'field' => $this->field,
                'calendar_interval' => $this->calendarInterval,
            ]
        ];
    }
}
