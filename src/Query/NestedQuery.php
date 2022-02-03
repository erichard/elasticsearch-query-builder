<?php

namespace Erichard\ElasticQueryBuilder\Query;

class NestedQuery implements QueryInterface
{
    /** @var string */
    protected $path;
    /** @var QueryInterface */
    protected $query;

    public function __construct(?string $path, QueryInterface $query)
    {
        $this->path = $path;
        $this->query = $query;
    }

    public function setNestedPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    public function setQuery(QueryInterface $query)
    {
        $this->query = $query;

        return $this;
    }

    public function build(): array
    {
        return [
            'nested' => [
                'path' => $this->path,
                'query' => $this->query->build(),
            ],
        ];
    }
}
