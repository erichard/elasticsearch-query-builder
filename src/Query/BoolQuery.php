<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\QueryException;

class BoolQuery implements QueryInterface
{
    /**
     * @param array<QueryInterface> $must
     * @param array<QueryInterface> $mustNot
     * @param array<QueryInterface> $should
     * @param array<QueryInterface> $filter
     */
    public function __construct(
        private array $must = [],
        private array $mustNot = [],
        private array $should = [],
        private array $filter = [],
        private array $params = [],
    ) {
    }

    public function addMust(QueryInterface $query): self
    {
        if ($query === $this) {
            throw new QueryException('You are trying to add self to a bool query');
        }

        $this->must[] = $query;

        return $this;
    }

    public function addMustNot(QueryInterface $query): self
    {
        if ($query === $this) {
            throw new QueryException('You are trying to add self to a bool query');
        }

        $this->mustNot[] = $query;

        return $this;
    }

    public function addShould(QueryInterface $query): self
    {
        if ($query === $this) {
            throw new QueryException('You are trying to add self to a bool query');
        }

        $this->should[] = $query;

        return $this;
    }

    public function addFilter(QueryInterface $query): self
    {
        if ($query === $this) {
            throw new QueryException('You are trying to add self to a bool query');
        }

        $this->filter[] = $query;

        return $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->must)
            && empty($this->mustNot)
            && empty($this->should)
            && empty($this->filter);
    }

    public function build(): array
    {
        $query = $this->params;

        $this
            ->buildQueries($query, 'should', $this->should)
            ->buildQueries($query, 'filter', $this->filter)
            ->buildQueries($query, 'must_not', $this->mustNot)
            ->buildQueries($query, 'must', $this->must);

        if ((is_countable($query) ? count($query) : 0) === 0) {
            throw new QueryException('Empty BoolQuery');
        }

        return [
            'bool' => $query,
        ];
    }

    /**
     * @param array<QueryInterface> $queries
     *
     * @return $this
     */
    protected function buildQueries(array &$query, string $name, array $queries): self
    {
        if ([] === $queries) {
            return $this;
        }

        $query[$name] = [];

        foreach ($queries as $filter) {
            $query[$name][] = $filter->build();
        }

        return $this;
    }
}
