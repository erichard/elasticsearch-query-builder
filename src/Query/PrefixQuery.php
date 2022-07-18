<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasCaseInsensitive;
use Erichard\ElasticQueryBuilder\Features\HasField;
use Erichard\ElasticQueryBuilder\Features\HasRewrite;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-prefix-query.html
 */
class PrefixQuery implements QueryInterface
{
    use HasField;
    use HasRewrite;
    use HasCaseInsensitive;

    public function __construct(
        string $field,
        protected string $value,
        ?string $rewrite = null,
        ?bool $caseInsensitive = null
    ) {
        $this->field = $field;
        $this->rewrite = $rewrite;
        $this->caseInsensitive = $caseInsensitive;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): array
    {
        $build = [
            'value' => $this->value,
        ];

        $this->buildRewriteTo($build);
        $this->buildCaseInsensitiveTo($build);

        return [
            'prefix' => [
                $this->field => $build,
            ]
        ];
    }
}
