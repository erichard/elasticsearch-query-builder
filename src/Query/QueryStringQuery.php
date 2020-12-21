<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class QueryStringQuery implements QueryInterface
{
    /** @var string */
    protected $query;

    /** @var string */
    protected $defaultField;

    public function __construct(string $query, string $defaultField = null)
    {
        $this->query = $query;
        $this->defaultField = $defaultField;
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
