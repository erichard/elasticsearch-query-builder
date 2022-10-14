<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasBoost;
use Erichard\ElasticQueryBuilder\Features\HasCaseInsensitive;
use Erichard\ElasticQueryBuilder\Features\HasField;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-term-query.html
 */
class TermQuery implements QueryInterface
{
    use HasField;
    use HasBoost;
    use HasCaseInsensitive;

    public function __construct(
        string $field,
        protected string|int|float|bool $value,
        ?float $boost = null,
        ?bool $caseInsensitive = null,
        protected array $params = [],
    ) {
        $this->field = $field;
        $this->boost = $boost;
        $this->caseInsensitive = $caseInsensitive;
    }

    public function setValue(string|int|float|bool $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    public function build(): array
    {
        $build = $this->params;
        $build[$this->field] = [
            'value' => $this->value,
        ];

        $this->buildBoostTo($build[$this->field]);
        $this->buildCaseInsensitiveTo($build[$this->field]);

        return [
            'term' => $build,
        ];
    }
}
