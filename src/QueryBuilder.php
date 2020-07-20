<?php

namespace Erichard\ElasticQueryBuilder;

use Erichard\ElasticQueryBuilder\Aggregation\Aggregation;
use Erichard\ElasticQueryBuilder\Query\Query;
use Erichard\ElasticQueryBuilder\Query\QueryInterface;

class QueryBuilder
{
    /** @var string|null */
    private $index;

    /** @var mixed|null */
    private $source;

    /** @var int|null */
    private $from;

    /** @var int|null */
    private $size;

    /** @var array */
    private $aggregations = [];

    /** @var Query|null */
    private $query;

    /** @var Query */
    private $postFilter;

    /** @var array */
    private $sort = [];

    public function setSource($source): self
    {
        $this->source = $source;

        return $this;
    }

    public function setIndex(string $index): self
    {
        $this->index = $index;

        return $this;
    }

    public function setFrom(int $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function addSort(string $field, array $config): self
    {
        $this->sort[$field] = $config;

        return $this;
    }

    public function addAggregation(Aggregation $aggregation): self
    {
        $this->aggregations[] = $aggregation;

        return $this;
    }

    public function setQuery(QueryInterface $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function setPostFilter(QueryInterface $query): self
    {
        $this->postFilter = $query;

        return $this;
    }

    public function build(): array
    {
        $query = [
            'body' => [],
        ];

        if (null !== $this->index) {
            $query['index'] = $this->index;
        }

        if (null !== $this->from) {
            $query['from'] = $this->from;
        }

        if (null !== $this->size) {
            $query['size'] = $this->size;
        }

        if (null !== $this->source) {
            $query['_source'] = $this->source;
        }

        if (!empty($this->aggregations)) {
            $query['body']['aggs'] = [];
            foreach ($this->aggregations as $aggregation) {
                $query['body']['aggs'][$aggregation->getName()] = $aggregation->buildRecursivly();
            }
        }

        if (null !== $this->query) {
            $query['body']['query'] = $this->query->build();
        }

        if (null !== $this->postFilter) {
            $query['body']['post_filter'] = $this->postFilter->build();
        }

        if (!empty($this->sort)) {
            $query['body']['sort'] = [];
            foreach ($this->sort as $sort => $config) {
                $query['body']['sort'][$sort] = $config;
            }
        }

        return $query;
    }
}
