<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Features\HasFuzziness;
use Erichard\ElasticQueryBuilder\Features\HasMinimumShouldMatch;
use Erichard\ElasticQueryBuilder\Features\HasOperator;

class MatchQuery extends AbstractMatchQuery
{
    use HasFuzziness;
    use HasMinimumShouldMatch;
    use HasOperator;

    public function __construct(
        string $field,
        string|bool $query,
        ?string $analyzer = null,
        ?string $operator = null,
        ?string $minimumShouldMatch = null,
        ?string $fuzziness = null,
        array $params = [],
    ) {
        parent::__construct($field, $query, $analyzer, $params);

        $this->operator = $operator;
        $this->minimumShouldMatch = $minimumShouldMatch;
        $this->fuzziness = $fuzziness;
    }

    public function getQueryName(): string
    {
        return 'match';
    }

    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    public function build(): array
    {
        $build = parent::build();

        $this->buildOperatorTo($build[$this->getQueryName()][$this->field]);
        $this->buildMinimumShouldMatchTo($build[$this->getQueryName()][$this->field]);
        $this->buildFuzzinessTo($build[$this->getQueryName()][$this->field]);

        return $build;
    }
}
