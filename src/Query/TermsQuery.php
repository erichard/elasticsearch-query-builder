<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasBoost;
use Erichard\ElasticQueryBuilder\Features\HasField;

class TermsQuery implements QueryInterface
{
    use HasField;
    use HasBoost;

    /**
     * @param array<int, string|int|float|bool> $values
     */
    public function __construct(
        string $field,
        protected array $values,
        ?float $boost = null
    ) {
        $this->field = $field;
        $this->boost = $boost;
    }

    public function setValues(array $values): self
    {
        $this->values = $values;

        return $this;
    }

    public function build(): array
    {
        $build = [
            $this->field => array_values($this->values),
            // Ensure that user did not provide incorrect dictionary
        ];

        $this->buildBoostTo($build);

        return [
            'terms' => $build,
        ];
    }
}
