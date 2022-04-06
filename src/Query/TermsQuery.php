<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasField;

class TermsQuery implements QueryInterface
{
    use HasField;

    /**
     * @param array<int, string|int|float|bool> $values
     */
    public function __construct(
        string $field,
        protected array $values
    ) {
        $this->field = $field;
    }

    public function setValues(array $values): self
    {
        $this->values = $values;

        return $this;
    }

    public function build(): array
    {
        return [
            'terms' => [
                $this->field => array_values($this->values),
                // Ensure that user did not provide incorrect dictionary
            ],
        ];
    }
}
