<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Features\HasMinimumShouldMatch;
use Erichard\ElasticQueryBuilder\Features\HasOperator;

class MatchQuery extends AbstractMatchQuery
{
    use HasOperator;
    use HasMinimumShouldMatch;

    public function __construct(
        string $field,
        string $query,
        ?string $analyzer = null,
        ?string $operator = null,
        ?string $minimumShouldMatch = null,
        array $params = [],
    ) {
        parent::__construct($field, $query, $analyzer, $params);

        $this->operator = $operator;
        $this->minimumShouldMatch = $minimumShouldMatch;
    }

    public function getQueryName(): string
    {
        return 'match';
    }

    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    public function build(): array
    {
        $build = parent::build();

        $this->buildOperatorTo($build[$this->getQueryName()][$this->field]);
        $this->buildMinimumShouldMatchTo($build[$this->getQueryName()][$this->field]);

        return $build;
    }
}
