<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\QueryException;

class MinAggregation extends Aggregation
{
    private $field;
    private $script;
    private $valueScript;
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

    public function setValueScript(string $valueScript)
    {
        $this->valueScript = $valueScript;

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
        } else {
            $term = [
                'field' => $this->field,
            ];
        }

        if (null !== $this->valueScript) {
            throw new QueryException('Not implemented option.');
        }

        if (null !== $this->missing) {
            $term['missing'] = $this->missing;
        }

        $query = [
            'min' => $term,
        ];

        return $query;
    }
}
