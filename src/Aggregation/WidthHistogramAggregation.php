<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Features\HasField;

class WidthHistogramAggregation extends AbstractAggregation
{
    use HasField;

    public function __construct(
        string $name,
        string $field,
        private int $buckets,
        array $aggregations = []
    ) {
        parent::__construct($name, $aggregations);
        $this->field = $field;
    }

    protected function getType(): string
    {
        return 'variable_width_histogram';
    }

    protected function buildAggregation(): array
    {
        return [
            'field' => $this->field,
            'buckets' => $this->buckets,
        ];
    }
}
