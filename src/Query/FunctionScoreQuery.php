<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;

class FunctionScoreQuery implements QueryInterface
{
    protected ?string $boost = null;

    protected ?string $boostMode = null;

    private ?array $functions = null;

    /**
     * @param array[]|string[] $fields
     */
    public function __construct(
        protected array $fields,
        protected string $query,
    ) {
    }

    public function setBoost(string $boost): self
    {
        $this->boost = $boost;

        return $this;
    }

    public function setBoostMode(string $boostMode): self
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
        $build = [];
        if (null !== $this->boostMode) {
            $build['boost_mode'] = $this->boostMode;
        }

        if (null !== $this->functions) {
            $build['functions'] = $this->functions;
        }

        $build['query'] = [
            'query_string' => [
                'query' => $this->query,
                'fields' => $this->fields,
            ],
        ];

        if (null !== $this->boost) {
            $build['query']['query_string'] = $this->boost;
        }

        return [
            'function_score' => $build,
        ];
    }
}
