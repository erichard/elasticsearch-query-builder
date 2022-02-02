<?php

namespace Erichard\ElasticQueryBuilder\Query;

class Query
{
    public static function terms(string $field = null, array $values = []): TermsQuery
    {
        return new TermsQuery($field, $values);
    }

    public static function term(string $field = null, $value = null): TermQuery
    {
        return new TermQuery($field, $value);
    }

    public static function wildcard(string $field = null, $value = null): WildcardQuery
    {
        return new WildcardQuery($field, $value);
    }

    public static function bool(): BoolQuery
    {
        return new BoolQuery();
    }

    public static function range(string $field = null): RangeQuery
    {
        return new RangeQuery($field);
    }

    public static function nested(string $field = null, QueryInterface $query = null): NestedQuery
    {
        return new NestedQuery($field, $query);
    }

    public static function match(string $field = null, $query = null): MatchQuery
    {
        return new MatchQuery($field, $query);
    }

    public static function matchPhrase(string $field = null, $query = null): MatchPhraseQuery
    {
        return new MatchPhraseQuery($field, $query);
    }

    public static function matchPhrasePrefix(string $field = null, $query = null): MatchPhrasePrefixQuery
    {
        return new MatchPhrasePrefixQuery($field, $query);
    }

    public static function multiMatch(array $fields = [], $query = null, $type = null, $fuzziness = null): MultiMatchQuery
    {
        return new MultiMatchQuery($fields, $query, $type, $fuzziness);
    }

    public static function geoDistance(string $field = null, string $distance = null, array $position = []): GeoDistanceQuery
    {
        return new GeoDistanceQuery($distance, $field, $position);
    }

    public static function geoShape(string $field = null, ?string $type = null, array $coordinates = [], ?string $relation = null): GeoShapeQuery
    {
        return new GeoShapeQuery($field, $type, $coordinates, $relation);
    }

    public static function prefix(string $field = null, $value = null, float $boost = null): PrefixQuery
    {
        return new PrefixQuery($field, $value, $boost);
    }

    public static function queryString(string $query = null, string $defaultField = null): QueryStringQuery
    {
        return new QueryStringQuery($query, $defaultField);
    }

    public static function rankFeature(string $field = null, float $boost = null): RankFeatureQuery
    {
        return new RankFeatureQuery($field, $boost);
    }
}
