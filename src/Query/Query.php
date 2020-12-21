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

    public static function wildcard(): WildcardQuery
    {
        return new WildcardQuery();
    }

    public static function bool(): BoolQuery
    {
        return new BoolQuery();
    }

    public static function range(): RangeQuery
    {
        return new RangeQuery();
    }

    public static function nested(): NestedQuery
    {
        return new NestedQuery();
    }

    public static function match(): MatchQuery
    {
        return new MatchQuery();
    }

    public static function matchPhrase(): MatchPhraseQuery
    {
        return new MatchPhraseQuery();
    }

    public static function matchPhrasePrefix(): MatchPhrasePrefixQuery
    {
        return new MatchPhrasePrefixQuery();
    }

    public static function multiMatch(): MultiMatchQuery
    {
        return new MultiMatchQuery();
    }

    public static function geoDistance(): GeoDistanceQuery
    {
        return new GeoDistanceQuery();
    }

    public static function prefix(): PrefixQuery
    {
        return new PrefixQuery();
    }

    public static function queryString(string $query, string $defaultField = null): QueryStringQuery
    {
        return new QueryStringQuery($query, $defaultField);
    }
}
