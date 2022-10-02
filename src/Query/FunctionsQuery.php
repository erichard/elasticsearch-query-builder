<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;

class FunctionsQuery implements QueryInterface
{
    public function __construct(
        protected ?string $field = null,
        protected ?float $weight = null,
    ) {
    }

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function build(): array
    {
        $functions = [];
        $functions['filter'] = [
            'term' => [
                '_index' => $this->field,
            ],
        ];

        if (null !== $this->weight) {
            $functions['weight'] = $this->weight;
        }

        return $functions;
    }
}
