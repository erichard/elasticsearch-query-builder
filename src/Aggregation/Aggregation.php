<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Options\Field;
use Erichard\ElasticQueryBuilder\Options\InlineScript;
use Erichard\ElasticQueryBuilder\Options\SourceScript;

class Aggregation
{
    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public static function terms(
        string $name,
        string|Field|InlineScript $fieldOrSource,
        array $aggregations = []
    ): TermsAggregation {
        return new TermsAggregation($name, $fieldOrSource, $aggregations);
    }

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public static function dateHistogram(
        string $nameAndField,
        string $calendarInterval,
        ?string $field = null,
        array $aggregations = []
    ): DateHistogramAggregation {
        return new DateHistogramAggregation($nameAndField, $calendarInterval, $field, $aggregations);
    }

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public static function nested(string $name, string $path, array $aggregations = []): NestedAggregation
    {
        return new NestedAggregation($name, $path, $aggregations);
    }

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public static function reverseNested(string $name, string $path, array $aggregations = []): ReverseNestedAggregation
    {
        return new ReverseNestedAggregation($name, $path, $aggregations);
    }

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public static function filter(string $name, QueryInterface $query, array $aggregations = []): FilterAggregation
    {
        return new FilterAggregation($name, $query, $aggregations);
    }

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public static function cardinality(
        string $nameAndField,
        string|SourceScript|Field|null $fieldOrSource = null,
        array $aggregations = []
    ): CardinalityAggregation {
        return new CardinalityAggregation($nameAndField, $fieldOrSource, $aggregations);
    }

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public static function max(
        string $nameAndField,
        string|SourceScript|Field|null $fieldOrSource = null,
        array $aggregations = []
    ): MaxAggregation {
        return new MaxAggregation($nameAndField, $fieldOrSource, $aggregations);
    }

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public static function min(
        string $nameAndField,
        string|SourceScript|Field|null $fieldOrSource = null,
        array $aggregations = []
    ): MinAggregation {
        return new MinAggregation($nameAndField, $fieldOrSource, $aggregations);
    }

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public static function sum(
        string $nameAndField,
        string|SourceScript|Field|null $fieldOrSource = null,
        array $aggregations = []
    ): SumAggregation {
        return new SumAggregation($nameAndField, $fieldOrSource, $aggregations);
    }

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public static function topHits(string $name, array $aggregations = []): TopHitsAggregation
    {
        return new TopHitsAggregation($name, $aggregations);
    }
}
