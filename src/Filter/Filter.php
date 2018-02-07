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

    public static function geoDistance()
    {
        return new GeoDistanceFilter();
    }
}
