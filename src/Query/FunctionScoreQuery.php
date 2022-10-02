<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;

class FunctionScoreQuery implements QueryInterface
{
    private ?array $functions = null;

    /**
     * @param array[]|string[] $fields
     */
    public function __construct(
        protected array $fields,
        protected string $query,
        protected ?string $boost = null,
        protected ?string $boostMode = null,
    ) {
    }

    public function setFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function setBoost(?string $boost): self
    {
        $this->boost = $boost;

        return $this;
    }

    public function setBoostMode(?string $boostMode): self
    {
        $this->boostMode = $boostMode;

        return $this;
    }

    public function setFunctions(array $functions): self
    {
        $this->functions = $functions;

        return $this;
    }

    public function build(): array
    {
        if ($this->boostMode !== null) {
            $build['boost_mode'] = $this->boostMode;
        }

        if ($this->functions !== null) {
            $build['functions'] = $this->functions;
        }

        $build['query'] = [
            'query_string' => [
                'query' => $this->query,
                'fields' => $this->fields,
            ],
        ];

        if ($this->boost !== null) {
            $build['query']['query_string'] = $this->boost;
        }

        return [
            'function_score' => $build,
        ];
    }
}
