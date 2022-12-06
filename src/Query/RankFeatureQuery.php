<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasBoost;
use Erichard\ElasticQueryBuilder\Features\HasField;

class RankFeatureQuery implements QueryInterface
{
    use HasBoost;
    use HasField;

    public function __construct(
        string $field,
        ?float $boost = null,
        protected array $params = [],
    ) {
        $this->field = $field;
        $this->boost = $boost;
    }

    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    public function build(): array
    {
        $build = $this->params;
        $build['field'] = $this->field;

        $this->buildBoostTo($build);

        return [
            'rank_feature' => $build,
        ];
    }
}
