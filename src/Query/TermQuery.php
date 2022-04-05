<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasField;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-term-query.html
 */
class TermQuery implements QueryInterface
{
    use HasField;

    public function __construct(
        string $field,
        protected string|int|float|bool $value
    ) {
        $this->field = $field;
    }

    public function setValue(string|int|float|bool $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): array
    {
        return [
            'term' => [
                $this->field => $this->value,
            ],
        ];
    }
}
