<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

class TermsAggregation extends Aggregation
{
    private $field;
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

        return [
            'terms' => $term,
        ];
    }
}
