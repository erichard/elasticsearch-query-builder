<?php

namespace Erichard\ElasticQueryBuilder\Query;

class MatchPhrasePrefixQuery implements QueryInterface
{
    /** @var string */
    protected $field;

    /** @var string */
    protected $query;

    /** @var string */
    protected $analyzer;

    public function __construct(string $field, string $query, string $analyzer = null)
    {
        $this->field = $field;
        $this->query = $query;
        $this->analyzer = $analyzer;
    }

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

    public function setAnalyzer(string $analyzer)
    {
        $this->analyzer = $analyzer;

        return $this;
    }

    public function build(): array
    {
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
