<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\QueryException;

class MatchPhrasePrefixFilter extends Filter
{
    protected $field;
    protected $query;
    protected $analyzer;

    public function setField(string $field)
    {
        $this->field = $field;

        return $this;
    }

    public function setQuery(string $query)
    {
        $this->query = $query;

        return $this;
    }

    public function setAnalyzer($analyzer)
    {
        $this->analyzer = $analyzer;

        return $this;
    }

    public function build(): array
    {
        if (null === $this->query) {
            throw new QueryException('You need to call setQuery() on'.__CLASS__);
        }

        $query = [
            'match_phrase_prefix' => [
                $this->field => [
                    'query' => $this->query,
                ],
            ],
        ];

        if (null !== $this->analyzer) {
            $query['match_phrase_prefix'][$this->field]['analyzer'] = $this->analyzer;
        }

        return $query;
    }
}
