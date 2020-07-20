<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

abstract class Aggregation
{
    /** @var string */
    private $name;

    abstract public function build(): array;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function terms(string $name): TermsAggregation
    {
        return new TermsAggregation($name);
    }

    public static function nested(string $name): NestedAggregation
    {
        return new NestedAggregation($name);
    }

    public static function reverseNested(string $name): ReverseNestedAggregation
    {
        return new ReverseNestedAggregation($name);
    }

    public static function filter(string $name): FilterAggregation
    {
        return new FilterAggregation($name);
    }

    public static function max(string $name): MaxAggregation
    {
        return new MaxAggregation($name);
    }

    public static function min(string $name): MinAggregation
    {
        return new MinAggregation($name);
    }

    public static function topHits(string $name): TopHitsAggregation
    {
        return new TopHitsAggregation($name);
    }
}
