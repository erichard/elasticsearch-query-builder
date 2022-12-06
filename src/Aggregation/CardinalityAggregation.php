<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Options\Field;
use Erichard\ElasticQueryBuilder\Options\SourceScript;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-metrics-cardinality-aggregation.html
 */
class CardinalityAggregation extends MetricAggregation
{
    public function __construct(
        string $nameAndField,
        Field|SourceScript|string|null $fieldOrSource = null,
        array $aggregations = [],
        private ?int $precisionThreshold = null,
    ) {
        parent::__construct($nameAndField, $fieldOrSource, $aggregations);
    }

    public function setPrecisionThreshold(?int $precisionThreshold): self
    {
        $this->precisionThreshold = $precisionThreshold;

        return $this;
    }

    public function getPrecisionThreshold(): ?int
    {
        return $this->precisionThreshold;
    }

    protected function getType(): string
    {
        return 'cardinality';
    }

    protected function buildAggregation(): array
    {
        $build = parent::buildAggregation();

        if (null !== $this->precisionThreshold) {
            $build['precision_threshold'] = $this->precisionThreshold;
        }

        return $build;
    }
}
