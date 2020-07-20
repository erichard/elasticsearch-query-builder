<?php

namespace Erichard\ElasticQueryBuilder\Query;

class NestedQuery implements QueryInterface
{
    protected $path;
    protected $query;

    public function setNestedPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    public function setQuery(Query $query)
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
