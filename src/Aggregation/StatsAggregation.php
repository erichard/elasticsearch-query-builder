<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-metrics-stats-aggregation.html
 */
class StatsAggregation extends MetricAggregation
{
    protected function getType(): string
    {
        return 'stats';
    }
}
