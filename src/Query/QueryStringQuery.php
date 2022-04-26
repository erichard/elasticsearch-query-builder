<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;

class QueryStringQuery implements QueryInterface
{
    public function __construct(
        protected string $query,
        protected ?string $defaultField = null
    ) {
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function setDefaultField(?string $defaultField): self
    {
        $this->defaultField = $defaultField;

        return $this;
    }

    public function build(): array
    {
        $build = [
            'query' => $this->query,
        ];

        if (null !== $this->defaultField) {
            $build['default_field'] = $this->defaultField;
        }

        return [
            'query_string' => $build,
        ];
    }
}
