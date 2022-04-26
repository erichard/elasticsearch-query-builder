<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Constants\SortDirections;
use Erichard\ElasticQueryBuilder\Options\Field;
use Erichard\ElasticQueryBuilder\Options\InlineScript;
use Erichard\ElasticQueryBuilder\QueryException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-bucket-terms-aggregation.html
 */
class TermsAggregation extends AbstractAggregation
{
    private ?InlineScript $script = null;

    private ?Field $field = null;

    /**
     * @param string|Field|InlineScript $fieldOrSource string === field
     */
    public function __construct(
        string $name,
        string|Field|InlineScript $fieldOrSource,
        array $aggregations = [],
        private string|null $orderField = null,
        private string $orderValue = SortDirections::ASC,
        private array|string|null $include = null,
        private array|string|null $exclude = null,
        private int $size = 10,
    ) {
        parent::__construct($name, $aggregations);

        if (is_string($fieldOrSource)) {
            $this->field = new Field($fieldOrSource);
        } elseif ($fieldOrSource instanceof Field) {
            $this->field = $fieldOrSource;
        } elseif ($fieldOrSource instanceof InlineScript) {
            $this->script = $fieldOrSource;
        } else {
            throw new QueryException('Invalid field or source argument in metric aggregation');
        }
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function setOrder(string|null $orderField, string $orderValue = SortDirections::ASC): self
    {
        $this->orderField = $orderField;
        $this->orderValue = $orderValue;

        return $this;
    }

    public function setInclude(array|string|null $include): self
    {
        $this->include = $include;

        return $this;
    }

    public function setExclude(array|string|null $exclude): self
    {
        $this->exclude = $exclude;

        return $this;
    }

    protected function buildAggregation(): array
    {
        $build = [];
        if (null !== $this->script) {
            $build = [
                'script' => $this->script->build(),
            ];
        } elseif (null !== $this->field) {
            $build = $this->field->build() + [
                'size' => $this->size,
            ];
        }

        if (null !== $this->orderField) {
            $build['order'] = [
                $this->orderField => $this->orderValue,
            ];
        }

        if (null !== $this->include) {
            $build['include'] = $this->include;
        }

        if (null !== $this->exclude) {
            $build['exclude'] = $this->exclude;
        }

        return $build;
    }

    protected function getType(): string
    {
        return 'terms';
    }
}
