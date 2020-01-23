<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

class TopHitsAggregation extends Aggregation
{
    private $script;
    private $size = 3;

    public function setScript(string $script)
    {
        $this->script = $script;

        return $this;
    }

    public function setSize(int $size)
    {
        $this->size = $size;

        return $this;
    }

    public function build(): array
    {
        if (null !== $this->script) {
            $term = [
                '_source' => [
                    'includes' => $this->script,
                ],
                'size' => $this->size,
            ];
        }

        $query = [
            'top_hits' => $term,
        ];

        return $query;
    }
}
