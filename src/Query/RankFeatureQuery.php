<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class RankFeatureQuery implements QueryInterface
{
    /** @var string */
    protected $field;

    /** @var float */
    protected $boost;

    public function __construct(?string $field = null, ?float $boost = null)
    {
        $this->field = $field;
        $this->boost = $boost;
    }

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function setBoost(float $boost): self
    {
        $this->boost = $boost;

        return $this;
    }

    public function build(): array
    {
        $query = [
            'rank_feature' => [
                'field' => $this->field,
            ],
        ];

        if (null !== $this->boost) {
            $query['rank_feature']['boost'] = $this->boost;
        }

        return $query;
    }
}
