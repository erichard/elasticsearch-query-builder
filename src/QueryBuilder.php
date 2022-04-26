<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasAggregations;
use Erichard\ElasticQueryBuilder\Features\HasCollapse;
use Erichard\ElasticQueryBuilder\Features\HasSorting;

class QueryBuilder
{
    use HasCollapse;
    use HasSorting;
    use HasAggregations;

    private ?string $index = null;

    private array|bool|string|null $source = null;

    private ?int $from = null;

    private ?int $size = null;

    private ?QueryInterface $query = null;

    private ?QueryInterface $postFilter = null;

    public function setSource(array|bool|string|null $source): self
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

        if (null !== $this->query) {
            $query['body']['query'] = $this->query->build();
        }

        if (null !== $this->postFilter) {
            $query['body']['post_filter'] = $this->postFilter->build();
        }

        $this->buildSortTo($query['body'])
            ->buildAggregationsTo($query['body'])
            ->buildCollapseTo($query['body']);

        return $query;
    }

    public function getSource(): bool|array|string|null
    {
        return $this->source;
    }

    public function getFrom(): ?int
    {
        return $this->from;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function getQuery(): ?QueryInterface
    {
        return $this->query;
    }

    public function getPostFilter(): ?QueryInterface
    {
        return $this->postFilter;
    }
}
