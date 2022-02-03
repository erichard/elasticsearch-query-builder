<?php

namespace Erichard\ElasticQueryBuilder\Query;

class Query
{
    public static function terms(string $field, array $values): TermsQuery
    {
        return new TermsQuery($field, $values);
    }

    public static function term(string $field, $value): TermQuery
    {
        return new TermQuery($field, $value);
    }

    public static function wildcard(string $field, $value): WildcardQuery
    {
        return new WildcardQuery($field, $value);
    }

    public static function bool(): BoolQuery
    {
        return new BoolQuery();
    }

    public static function range(string $field): RangeQuery
    {
        return new RangeQuery($field);
    }

    public static function nested(string $field, QueryInterface $query): NestedQuery
    {
        return new NestedQuery($field, $query);
    }

    public static function match(string $field, $query): MatchQuery
    {
        return new MatchQuery($field, $query);
    }

    public static function matchPhrase(string $field, $query): MatchPhraseQuery
    {
        return new MatchPhraseQuery($field, $query);
    }

    public static function matchPhrasePrefix(string $field, $query): MatchPhrasePrefixQuery
    {
        return new MatchPhrasePrefixQuery($field, $query);
    }

    public static function multiMatch(array $fields, $query): MultiMatchQuery
    {
        return new MultiMatchQuery($fields, $query);
    }

    public static function geoDistance(string $field, string $distance, array $position): GeoDistanceQuery
    {
        return new GeoDistanceQuery($distance, $field, $position);
    }

    public static function geoShape(string $field, string $type, array $coordinates): GeoShapeQuery
    {
        return new GeoShapeQuery($field, $type, $coordinates);
    }

    public static function prefix(string $field, $value): PrefixQuery
    {
        return new PrefixQuery($field, $value);
    }

    public static function queryString(string $query, string $defaultField = null): QueryStringQuery
    {
        return new QueryStringQuery($query);
    }

    public static function rankFeature(string $field): RankFeatureQuery
    {
        return new RankFeatureQuery($field);
    }
}
