<?php

namespace Erichard\ElasticQueryBuilder\Filter;

class NestedFilter extends Filter
{
    protected $path;
    protected $filter;

    public function setNestedPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    public function setFilter(Filter $filter)
    {
        $this->filter = $filter;

        return $this;
    }

    public function build(): array
    {
        return [
            'nested' => [
                'path' => $this->path,
                'query' => $this->filter->build(),
            ],
        ];
    }
}
