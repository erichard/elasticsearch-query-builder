<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\QueryException;

class MinAggregation extends Aggregation
{
    /** @var string */
    private $field;

    /** @var string */
    private $script;

    /** @var integer */
    private $missing;

    public function setField(string $field)
    {
        $this->field = $field;

        return $this;
    }

    public function setScript(string $script)
    {
        $this->script = $script;

        return $this;
    }

    public function setMissing(int $missing)
    {
        $this->missing = $missing;

        return $this;
    }

    public function build(): array
    {
        if (null !== $this->script) {
            $term = [
                'script' => [
                    'source' => $this->script,
                ],
            ];
        } elseif (null !== $this->field) {
            $term = [
                'field' => $this->field,
            ];
        } else {
            throw new QueryException('You should call MinAggregation::setField() or MinAggregation::setScript() ');
        }

        if (null !== $this->missing) {
            $term['missing'] = $this->missing;
        }

        return [
            'min' => $term,
        ];
    }
}
