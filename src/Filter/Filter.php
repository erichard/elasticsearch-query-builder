<?php

namespace Erichard\ElasticQueryBuilder\Filter;

abstract class Filter
{
    abstract public function build(): array;

    public static function terms()
    {
        return new TermsFilter();
    }

    public static function term()
    {
        return new TermFilter();
    }

    public static function wildcard()
    {
        return new WildcardFilter();
    }

    public static function bool()
    {
        return new BoolFilter();
    }

    public static function range()
    {
        return new RangeFilter();
    }

    public static function nested()
    {
        return new NestedFilter();
    }

    public static function match()
    {
        return new MatchFilter();
    }

    public static function matchPhrase()
    {
        return new MatchPhraseFilter();
    }

    public static function matchPhrasePrefix()
    {
        return new MatchPhrasePrefixFilter();
    }

    public static function multiMatch()
    {
        return new MultiMatchFilter();
    }

    public static function geoDistance()
    {
        return new GeoDistanceFilter();
    }
}
