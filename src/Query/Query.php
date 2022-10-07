<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;

class Query
{
    /**
     * @param array<int, string|int|float|bool> $values
     */
    public static function terms(string $field, array $values, array $params = []): TermsQuery
    {
        return new TermsQuery(
            field: $field,
            values: $values,
            params: $params,
        );
    }

    public static function term(string $field, string|int|float|bool $value, array $params = []): TermQuery
    {
        return new TermQuery(
            field: $field,
            value: $value,
            params: $params,
        );
    }

    public static function wildcard(string $field, string $value, array $params = []): WildcardQuery
    {
        return new WildcardQuery(
            field: $field,
            value: $value,
            params: $params,
        );
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
        array $params = [],
    ): BoolQuery {
        return new BoolQuery(
            must: $must,
            mustNot: $mustNot,
            should: $should,
            filter: $filter,
            params: $params,
        );
    }

    public static function range(
        string $field,
        int|float|string|null $lt = null,
        int|float|string|null $gt = null,
        int|float|string|null $lte = null,
        int|float|string|null $gte = null,
        array $params = [],
    ): RangeQuery {
        return new RangeQuery(
            field: $field,
            lt: $lt,
            gt: $gt,
            lte: $lte,
            gte: $gte,
            params: $params,
        );
    }

    public static function nested(string $field, QueryInterface $query, array $params = []): NestedQuery
    {
        return new NestedQuery(
            path: $field,
            query: $query,
            params: $params,
        );
    }

    public static function match(string $field, string $query, array $params = []): MatchQuery
    {
        return new MatchQuery(
            field: $field,
            query: $query,
            params: $params,
        );
    }

    public static function matchPhrase(string $field, string $query, array $params = []): MatchPhraseQuery
    {
        return new MatchPhraseQuery(
            field: $field,
            query: $query,
            params: $params,
        );
    }

    public static function matchPhrasePrefix(string $field, string $query, array $params = []): MatchPhrasePrefixQuery
    {
        return new MatchPhrasePrefixQuery(
            field: $field,
            query: $query,
            params: $params,
        );
    }

    public static function multiMatch(array $fields, string $query, array $params = []): MultiMatchQuery
    {
        return new MultiMatchQuery(
            fields: $fields,
            query: $query,
            params: $params,
        );
    }

    /**
     * @param float[]|int[] $position
     */
    public static function geoDistance(string $field, string $distance, array $position, array $params = []): GeoDistanceQuery
    {
        return new GeoDistanceQuery(
            distance: $distance,
            field: $field,
            position: $position,
            params: $params,
        );
    }

    /**
     * @param mixed[]|float[]|int[] $coordinates
     */
    public static function geoShape(string $field, string $type, array $coordinates, array $params = []): GeoShapeQuery
    {
        return new GeoShapeQuery(
            field: $field,
            type: $type,
            coordinates: $coordinates,
            params: $params,
        );
    }

    public static function prefix(string $field, string $value, array $params = []): PrefixQuery
    {
        return new PrefixQuery(
            field: $field,
            value: $value,
            params: $params,
        );
    }

    public static function queryString(string $query, string $defaultField = null, array $params = []): QueryStringQuery
    {
        return new QueryStringQuery(
            query: $query,
            defaultField: $defaultField,
            params: $params,
        );
    }

    public static function rankFeature(string $field, array $params = []): RankFeatureQuery
    {
        return new RankFeatureQuery(
            field: $field,
            params: $params,
        );
    }
}
