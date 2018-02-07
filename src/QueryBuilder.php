<?php

namespace Erichard\ElasticQueryBuilder;

use Erichard\ElasticQueryBuilder\Aggregation\Aggregation;
use Erichard\ElasticQueryBuilder\Filter\Filter;

class QueryBuilder
{
    /**
     * @var array
     */
    private $query;

    /**
     * @var array
     */
    private $aggregations = [];

    /**
     * @var array
     */
    private $filters = [];

    /**
     * @var Filter
     */
    private $postFilter;

    public function __construct(array $query = [])
    {
        $this->query = $query;
    }

    public function setType($type)
    {
        $this->query['type'] = $type;

        return $this;
    }

    public function setIndex($index)
    {
        $this->query['index'] = $index;

        return $this;
    }

    public function setFrom($from)
    {
        $this->query['from'] = $from;

        return $this;
    }

    public function setSize($size)
    {
        $this->query['size'] = $size;

        return $this;
    }

    public function setSort(array $sort)
    {
        $this->query['sort'] = $sort;

        return $this;
    }

    public function addAggregation(Aggregation $aggregation)
    {
        $this->aggregations[] = $aggregation;

        return $this;
    }

    public function addFilter(Filter $filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    public function setPostFilter(Filter $filter)
    {
        $this->postFilter = $filter;
    }

    public function getQuery()
    {
        $query = $this->query;

        if (!empty($this->aggregations)) {
            $query['body']['aggs'] = [];
            foreach ($this->aggregations as $aggregation) {
                $query['body']['aggs'][$aggregation->getName()] = $aggregation->build();
            }
        }

        if (!empty($this->filters)) {
            $query['body']['query'] = [];
            foreach ($this->filters as $filter) {
                $query['body']['query'] = $filter->build();
            }
        }

        if (null !== $this->postFilter) {
            $query['body']['post_filter'] = $this->postFilter->build();
        }

        return $query;
    }
}
