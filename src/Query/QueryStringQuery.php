<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasBoost;
use Erichard\ElasticQueryBuilder\Features\HasMinimumShouldMatch;
use Erichard\ElasticQueryBuilder\Features\HasRewrite;

class QueryStringQuery implements QueryInterface
{
    use HasBoost;
    use HasMinimumShouldMatch;
    use HasRewrite;

    public function __construct(
        protected string $query,
        protected ?string $defaultField = null,
        protected ?string $defaultOperator = null,
        protected ?array $fields = null,
        ?float $boost = null,
        ?string $minimumShouldMatch = null,
        ?string $rewrite = null,
        protected array $params = [],
    ) {
        $this->boost = $boost;
        $this->minimumShouldMatch = $minimumShouldMatch;
        $this->rewrite = $rewrite;
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

    public function setDefaultOperator(?string $defaultOperator): self
    {
        $this->defaultOperator = $defaultOperator;

        return $this;
    }

    public function setFields(?array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function build(): array
    {
        $build = $this->params;
        $build['query'] = $this->query;

        if (null !== $this->defaultField) {
            $build['default_field'] = $this->defaultField;
        }

        if (null !== $this->defaultOperator) {
            $build['default_operator'] = $this->defaultOperator;
        }

        if (null !== $this->fields) {
            $build['fields'] = $this->fields;
        }

        $this->buildBoostTo($build);
        $this->buildMinimumShouldMatchTo($build);
        $this->buildRewriteTo($build);

        return [
            'query_string' => $build,
        ];
    }
}
