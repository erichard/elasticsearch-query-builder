<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasField;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-prefix-query.html
 */
class PrefixQuery implements QueryInterface
{
    use HasField;

    public function __construct(
        string $field,
        protected string $value,
        protected ?float $boost = null
    ) {
        $this->field = $field;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setBoost(?float $boost): self
    {
        $this->boost = $boost;

        return $this;
    }

    public function build(): array
    {
        $value = $this->value;

        if (null !== $this->boost) {
            $value = [
                'value' => $this->value,
                'boost' => $this->boost,
            ];
        }

        return [
            'prefix' => [
                $this->field => $value,
            ],
        ];
    }
}
