<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasBoost;
use Erichard\ElasticQueryBuilder\Features\HasField;

class RankFeatureQuery implements QueryInterface
{
    use HasField;
    use HasBoost;

    public function __construct(string $field, ?float $boost = null) {
        $this->field = $field;
        $this->boost = $boost;
    }

    public function build(): array
    {
        $build = [
            'field' => $this->field,
        ];

        $this->buildBoostTo($build);

        return [
            'rank_feature' => $build,
        ];
    }
}
