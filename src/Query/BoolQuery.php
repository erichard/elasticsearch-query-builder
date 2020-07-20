<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class BoolQuery implements QueryInterface
{
    /** @var array|Query[] */
    private $must = [];

    /** @var array|Query[] */
    private $mustNot = [];

    /** @var array|Query[] */
    private $should = [];

    /** @var array|Query[] */
    private $filter = [];

    public function addMust(QueryInterface $query): self
    {
        $this->must[] = $query;

        return $this;
    }

    public function addMustNot(QueryInterface $query): self
    {
        $this->mustNot[] = $query;

        return $this;
    }

    public function addShould(QueryInterface $query): self
    {
        $this->should[] = $query;

        return $this;
    }

    public function addFilter(QueryInterface $query): self
    {
        $this->filter[] = $query;

        return $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->must)
            && empty($this->mustNot)
            && empty($this->should)
            && empty($this->query)
        ;
    }

    public function build(): array
    {
        $query = [];

        if (!empty($this->must)) {
            $query['must'] = [];
            foreach ($this->must as $f) {
                $query['must'][] = $f->build();
            }
        }

        if (!empty($this->mustNot)) {
            $query['must_not'] = [];
            foreach ($this->mustNot as $f) {
                $query['must_not'][] = $f->build();
            }
        }

        if (!empty($this->filter)) {
            $query['filter'] = [];
            foreach ($this->filter as $f) {
                $query['filter'][] = $f->build();
            }
        }

        if (!empty($this->should)) {
            $query['should'] = [];
            foreach ($this->should as $f) {
                $query['should'][] = $f->build();
            }
        }

        if (empty($query)) {
            throw new QueryException('Empty Query');
        }

        return [
            'bool' => $query,
        ];
    }
}
