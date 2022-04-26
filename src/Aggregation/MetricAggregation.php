<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Options\Field;
use Erichard\ElasticQueryBuilder\Options\SourceScript;
use Erichard\ElasticQueryBuilder\QueryException;

abstract class MetricAggregation extends AbstractAggregation
{
    private ?Field $field = null;

    private ?SourceScript $script = null;

    private ?int $missing = null;

    /**
     * @param array<AbstractAggregation> $aggregations
     */
    public function __construct(
        string $nameAndField,
        string|SourceScript|Field|null $fieldOrSource = null,
        array $aggregations = []
    ) {
        parent::__construct($nameAndField, $aggregations);

        if (null === $fieldOrSource) {
            $fieldOrSource = $nameAndField;
        }

        if (is_string($fieldOrSource)) {
            $this->field = new Field($fieldOrSource);
        } elseif ($fieldOrSource instanceof Field) {
            $this->field = $fieldOrSource;
        } elseif ($fieldOrSource instanceof SourceScript) {
            $this->script = $fieldOrSource;
        } else {
            throw new QueryException('Invalid field or source argument in metric aggregation');
        }
    }

    public function setField(string|Field $field): self
    {
        $this->script = null;
        $this->field = is_string($field) ? new Field($field) : $field;

        return $this;
    }

    public function setScript(string|SourceScript $script): self
    {
        $this->field = null;
        $this->script = is_string($script) ? new SourceScript($script) : $script;

        return $this;
    }

    public function getField(): ?Field
    {
        return $this->field;
    }

    public function setMissing(?int $missing): self
    {
        $this->missing = $missing;

        return $this;
    }

    protected function buildAggregation(): array
    {
        $term = [];
        if (null !== $this->script) {
            $term = $this->script->build();
        } elseif (null !== $this->field) {
            $term = $this->field->build();
        }

        if (null !== $this->missing) {
            $term['missing'] = $this->missing;
        }

        return $term;
    }
}
