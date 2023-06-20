<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasField;

abstract class AbstractMatchQuery implements QueryInterface
{
    use HasField;

    public function __construct(
        string $field,
        protected string|bool|int $query,
        protected ?string $analyzer = null,
        protected array $params = [],
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

    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    public function build(): array
    {
        $queryName = $this->getQueryName();

        $query = $this->params;
        $query[$queryName] = [
            $this->field => [
                'query' => $this->query,
            ],
        ];

        if (null !== $this->analyzer) {
            $query[$queryName][$this->field]['analyzer'] = $this->analyzer;
        }

        return $query;
    }

    abstract public function getQueryName(): string;
}
