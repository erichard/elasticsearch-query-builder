<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Aggregation;

use Erichard\ElasticQueryBuilder\Features\HasSorting;

class TopHitsAggregation extends AbstractAggregation
{
    use HasSorting;

    private ?string $script = null;

    private int $size = 3;

    public function setScript(?string $script): self
    {
        $this->script = $script;

        return $this;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    protected function getType(): string
    {
        return 'top_hits';
    }

    protected function buildAggregation(): array
    {
        $data = [
            'size' => $this->size,
        ];

        if (null !== $this->script) {
            $data['_source'] = [
                'includes' => $this->script,
            ];
        }

        $this->buildSortTo($data);

        return $data;
    }
}
