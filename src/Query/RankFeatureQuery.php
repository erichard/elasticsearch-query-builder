<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasField;

class RankFeatureQuery implements QueryInterface
{
    use HasField;

    public function __construct(
        string $field,
        protected ?float $boost = null
    ) {
        $this->field = $field;
    }

    public function setBoost(?float $boost): self
    {
        $this->boost = $boost;

        return $this;
    }

    public function build(): array
    {
        $build = [
            'field' => $this->field,
        ];

        if ($this->boost !== null) {
            $build['boost'] = $this->boost;
        }

        return [
            'rank_feature' => $build,
        ];
    }
}
