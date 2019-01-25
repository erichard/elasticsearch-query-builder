<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\QueryException;

class TermsAggregation extends Aggregation
{
    private $aggregation;
    private $field;
    private $orderField;
    private $orderValue;
    private $include;
    private $exclude;
    private $script;
    private $size = 10;

    public function setField(string $field)
    {
        $this->field = $field;

        return $this;
    }

    public function setSize(int $size)
    {
        $this->size = $size;

        return $this;
    }

    public function setScript(string $script)
    {
        $this->script = $script;

        return $this;
    }

    public function setOrder(string $orderField, string $orderValue = 'ASC')
    {
        $this->orderField = $orderField;
        $this->orderValue = $orderValue;

        return $this;
    }

    public function setInclude($include)
    {
        $this->include = $include;

        return $this;
    }

    public function setExclude($exclude)
    {
        $this->exclude = $exclude;

        return $this;
    }

    public function setAggregation(Aggregation $aggregation)
    {
        $this->aggregation = $aggregation;

        return $this;
    }

    public function build(): array
    {
        if (null !== $this->script) {
            $term = [
                'script' => [
                    'inline' => $this->script,
                    'lang' => 'painless',
                ],
            ];
        } else {
            $term = [
                'field' => $this->field,
                'size' => $this->size,
            ];
        }

        $query = [
            'terms' => $term,
        ];

        if (null !== $this->orderField) {
            $query['terms']['order'] = [
                $this->orderField => $this->orderValue,
            ];
        }

        if (null !== $this->include) {
            $query['terms']['include'] = $this->include;
        }

        if (null !== $this->exclude) {
            $query['terms']['exclude'] = $this->exclude;
        }

        if (null !== $this->aggregation) {
            $query['aggs'] = [
                $this->aggregation->getName() => $this->aggregation->build(),
            ];
        }

        return $query;
    }
}
