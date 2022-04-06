<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasField;

abstract class AbstractMatchQuery implements QueryInterface
{
    use HasField;

    public function __construct(
        string $field,
        protected string $query,
        protected ?string $analyzer = null
    ) {
        $this->field = $field;
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function setAnalyzer(?string $analyzer): self
    {
        $this->analyzer = $analyzer;

        return $this;
    }

    public function build(): array
    {
        $queryName = $this->getQueryName();

        $query = [
            $queryName => [
                $this->field => [
                    'query' => $this->query,
                ],
            ],
        ];

        if ($this->analyzer !== null) {
            $query[$queryName][$this->field]['analyzer'] = $this->analyzer;
        }

        return $query;
    }

    abstract public function getQueryName(): string;
}
