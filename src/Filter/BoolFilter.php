<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\QueryException;

class BoolFilter extends Filter
{
    private $must = [];
    private $mustNot = [];
    private $should = [];
    private $filter = [];

    public function addMust(Filter $filter)
    {
        $this->must[] = $filter;

        return $this;
    }

    public function addMustNot(Filter $filter)
    {
        $this->mustNot[] = $filter;

        return $this;
    }

    public function addShould(Filter $filter)
    {
        $this->should[] = $filter;

        return $this;
    }

    public function addFilter(Filter $filter)
    {
        $this->filter[] = $filter;

        return $this;
    }

    public function isEmpty()
    {
        return empty($this->must)
            && empty($this->mustNot)
            && empty($this->should)
            && empty($this->filter)
        ;
    }

    public function build(): array
    {
        $filter = [];

        if (!empty($this->must)) {
            $filter['must'] = [];
            foreach ($this->must as $f) {
                $filter['must'][] = $f->build();
            }
        }

        if (!empty($this->mustNot)) {
            $filter['must_not'] = [];
            foreach ($this->mustNot as $f) {
                $filter['must_not'][] = $f->build();
            }
        }

        if (!empty($this->filter)) {
            $filter['filter'] = [];
            foreach ($this->filter as $f) {
                $filter['filter'][] = $f->build();
            }
        }

        if (!empty($this->should)) {
            $filter['should'] = [];
            foreach ($this->should as $f) {
                $filter['should'][] = $f->build();
            }
        }

        if (empty($filter)) {
            throw new QueryException('Empty filter');
        }

        return [
            'bool' => $filter,
        ];
    }
}
