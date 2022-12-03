<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;

class Query
{
    /**
     * @param array<int, string|int|float|bool> $values
     */
    public static function terms(string $field, array $values): TermsQuery
    {
        return new TermsQuery($field, $values);
    }

    public static function term(string $field, string|int|float|bool $value): TermQuery
    {
        return new TermQuery($field, $value);
    }

    public static function wildcard(string $field, string $value): WildcardQuery
    {
        return new WildcardQuery($field, $value);
    }

    /**
     * @param array<QueryInterface> $must
     * @param array<QueryInterface> $mustNot
     * @param array<QueryInterface> $should
     * @param array<QueryInterface> $filter
     */
    public static function bool(
        array $must = [],
        array $mustNot = [],
        array $should = [],
        array $filter = [],
    ): BoolQuery {
        return new BoolQuery($must, $mustNot, $should, $filter);
    }

    public static function range(
        string $field,
        int|float|string|null $lt = null,
        int|float|string|null $gt = null,
        int|float|string|null $lte = null,
        int|float|string|null $gte = null,
    ): RangeQuery {
        return new RangeQuery($field, $lt, $gt, $lte, $gte);
    }

    public static function nested(string $field, QueryInterface $query): NestedQuery
    {
        return new NestedQuery($field, $query);
    }

    public static function match(string $field, string $query): MatchQuery
    {
        return new MatchQuery($field, $query);
    }

    public static function matchPhrase(string $field, string $query): MatchPhraseQuery
    {
        return new MatchPhraseQuery($field, $query);
    }

    public static function matchPhrasePrefix(string $field, string $query): MatchPhrasePrefixQuery
    {
        return new MatchPhrasePrefixQuery($field, $query);
    }

    public static function multiMatch(array $fields, string $query): MultiMatchQuery
    {
        return new MultiMatchQuery($fields, $query);
    }

    public static function functionScoreQuery(array $fields, string $query): FunctionScoreQuery
    {
        return new FunctionScoreQuery($fields, $query);
    }

    public static function functionsQuery(string $field): FunctionsQuery
    {
        return new FunctionsQuery($field);
    }

    /**
     * @param float[]|int[] $position
     */
    public static function geoDistance(string $field, string $distance, array $position): GeoDistanceQuery
    {
        return new GeoDistanceQuery($distance, $field, $position);
    }

    /**
     * @param mixed[]|float[]|int[] $coordinates
     */
    public static function geoShape(string $field, string $type, array $coordinates): GeoShapeQuery
    {
        return new GeoShapeQuery($field, $type, $coordinates);
    }

    public static function prefix(string $field, string $value): PrefixQuery
    {
        return new PrefixQuery($field, $value);
    }

    public static function queryString(string $query, string $defaultField = null): QueryStringQuery
    {
        return new QueryStringQuery($query, $defaultField);
    }

    public static function rankFeature(string $field): RankFeatureQuery
    {
        return new RankFeatureQuery($field);
    }
}
