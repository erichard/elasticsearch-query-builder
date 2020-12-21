<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class RankFeatureQuery implements QueryInterface
{
    /** @var string */
    protected $field;

    /** @var float */
    protected $boost;

    public function __construct(string $field, float $boost = null)
    {
        $this->field = $field;
        $this->boost = $boost;
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
