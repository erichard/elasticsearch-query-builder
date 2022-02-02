<?php

namespace Erichard\ElasticQueryBuilder\Query;

class QueryStringQuery implements QueryInterface
{
    /** @var string */
    protected $query;

    /** @var string */
    protected $defaultField;

    public function __construct(?string $query = null, string $defaultField = null)
    {
        $this->query = $query;
        $this->defaultField = $defaultField;
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function setDefaultField(string $defaultField): self
    {
        $this->defaultField = $defaultField;

        return $this;
    }

    public function build(): array
    {
        $query = [
            'query_string' => [
                'query' => $this->query,
            ],
        ];

        if (null !== $this->defaultField) {
            $query['query_string']['default_field'] = $this->defaultField;
        }

        return $query;
    }
}
