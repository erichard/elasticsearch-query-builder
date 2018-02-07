<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

abstract class Aggregation
{
    private $name;

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    abstract public function build(): array;

    public static function terms($name = null)
    {
        return new TermsAggregation($name);
    }

    public static function nested($name = null)
    {
        return new NestedAggregation($name);
    }

    public static function filter($name = null)
    {
        return new FilterAggregation($name);
    }
}
