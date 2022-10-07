<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;

class NestedQuery implements QueryInterface
{
    public function __construct(
        protected ?string $path,
        protected QueryInterface $query,
        protected array $params = [],
    ) {
    }

    public function setNestedPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setQuery(QueryInterface $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function build(): array
    {
        $build = $this->params;
        $build['nested'] = [
            'path' => $this->path,
            'query' => $this->query->build(),
        ];

        return $build;
    }
}
