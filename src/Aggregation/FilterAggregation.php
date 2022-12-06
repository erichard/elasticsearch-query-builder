<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;

class FilterAggregation extends AbstractAggregation
{
    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public function __construct(
        string $name,
        private QueryInterface $query,
        array $aggregations = []
    ) {
        parent::__construct($name, $aggregations);
    }

    public function getQuery(): QueryInterface
    {
        return $this->query;
    }

    public function setQuery(QueryInterface $query): void
    {
        $this->query = $query;
    }

    protected function getType(): string
    {
        return 'filter';
    }

    protected function buildAggregation(): array
    {
        return $this->query->build();
    }
}
