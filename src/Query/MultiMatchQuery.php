<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasBoost;
use Erichard\ElasticQueryBuilder\Features\HasMinimumShouldMatch;
use Erichard\ElasticQueryBuilder\Features\HasOperator;

class MultiMatchQuery implements QueryInterface
{
    use HasOperator;
    use HasBoost;
    use HasMinimumShouldMatch;

    /**
     * @param mixed[]|string[] $fields
     */
    public function __construct(
        protected array $fields,
        protected string $query,
        protected ?string $type = null,
        protected ?string $fuzziness = null,
        ?string $operator = null,
        ?float $boost = null,
        ?string $minimumShouldMatch = null,
        protected array $params = [],
    ) {
        $this->operator = $operator;
        $this->boost = $boost;
        $this->minimumShouldMatch = $minimumShouldMatch;
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

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setFuzziness(string $fuzziness): self
    {
        $this->fuzziness = $fuzziness;

        return $this;
    }

    public function build(): array
    {
        $data = [
            'query' => $this->query,
            'fields' => $this->fields,
        ];

        if (null !== $this->type) {
            $data['type'] = $this->type;
        }

        if (null !== $this->fuzziness) {
            $data['fuzziness'] = $this->fuzziness;
        }

        $this->buildOperatorTo($data);
        $this->buildBoostTo($data);
        $this->buildMinimumShouldMatchTo($data);

        $build = $this->params;
        $build['multi_match'] = $data;

        return $build;
    }
}
