<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Options\Field;
use Erichard\ElasticQueryBuilder\Options\SourceScript;


class ValueCountAggregation extends MetricAggregation
{
    public function __construct(
        string $nameAndField,
        Field|SourceScript|string|null $fieldOrSource = null,
        array $aggregations = []
    ) {
        parent::__construct($nameAndField, $fieldOrSource, $aggregations);
    }

    protected function getType(): string
    {
        return 'value_count';
    }

    protected function buildAggregation(): array
    {
        $build = parent::buildAggregation();

        return $build;
    }
}
