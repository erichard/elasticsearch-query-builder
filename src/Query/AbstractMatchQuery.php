<?php

namespace Erichard\ElasticQueryBuilder\Query;

abstract class AbstractMatchQuery implements QueryInterface
{
    /** @var string */
    protected $field;

    /** @var string */
    protected $query;

    /** @var string */
    protected $analyzer;

    public function __construct(string $field, string $query)
    {
        $this->field = $field;
        $this->query = $query;
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
        $queryName = $this->getQueryName();

        $query = [
            $queryName => [
                $this->field => [
                    'query' => $this->query,
                ],
            ],
        ];

        if (null !== $this->analyzer) {
            $query[$queryName][$this->field]['analyzer'] = $this->analyzer;
        }

        return $query;
    }

    abstract public function getQueryName(): string;
}
