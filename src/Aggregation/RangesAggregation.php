<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Features\HasField;

class RangesAggregation extends AbstractAggregation
{
    use HasField;

    /**
     * Builds automatically range aggregation with simple ranges array of numeric.
     *
     * @param array<int>                 $ranges                  pass desired ranges that will be converted to
     * linear range
     * @param array<AbstractAggregation> $aggregations
     * @param bool                       $equalConditionOnToRange Se to true if you want to do a histogram with 0
     * - 10, 10 - 15, and correctly count the number
     * (entry with 10 will be in first and seconds
     * segment
     */
    public function __construct(
        string $name,
        string $field,
        private array $ranges,
        array $aggregations = [],
        private bool $equalConditionOnToRange = false
    ) {
        parent::__construct($name, $aggregations);
        $this->field = $field;
    }

    public function getRanges(): array
    {
        return $this->ranges;
    }

    public function setRanges(array $ranges): self
    {
        $this->ranges = $ranges;

        return $this;
    }

    protected function getType(): string
    {
        return 'range';
    }

    protected function buildAggregation(): array
    {
        $ranges = [];
        $prevValue = 0;
        foreach ($this->ranges as $range) {
            $to = $range + ($this->equalConditionOnToRange ? 1 : 0); // To value is not included - increase it by 1
            $ranges[] = [
                'from' => $prevValue,
                'to' => $to,
                'key' => $range,
            ];
            $prevValue = $range; // Do not use increased value
        }

        // Append "others"
        $ranges[] = [
            'key' => $prevValue . '-*',
            'from' => $prevValue,
        ];

        return [
            'field' => $this->field,
            'ranges' => $ranges,
        ];
    }
}
