<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-constant-score-query.html
 */
class ConstantScoreQuery implements QueryInterface
{
    public function __construct(
        private QueryInterface $filter,
        private float $boost = 1.0,
    ) {}

    public function setBoost(float $boost): self
    {
        $this->boost = $boost;

        return $this;
    }

    public function build(): array
    {
        return [
            'constant_score' => [
                'filter' => $this->filter->build(),
                'boost' => $this->boost,
            ],
        ];
    }
}
