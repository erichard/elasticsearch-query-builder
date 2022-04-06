<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

use Erichard\ElasticQueryBuilder\Constants\SortDirections;

trait HasSorting
{
    /**
     * @var array<array<string>>|array<string>
     */
    protected array $sort = [];

    /**
     * Adds sort.
     *
     * @param array|string $config Can be order direction ('desc') or config (['order' => 'asc']]
     *
     * @return $this
     */
    public function addSort(string $field, string|array $config = SortDirections::ASC): self
    {
        $this->sort[$field] = $config;

        return $this;
    }

    /**
     * Adds sort settings to array if sorting was set.
     */
    protected function buildSortTo(array &$toArray): self
    {
        if (empty($this->sort) === false) {
            foreach ($this->sort as $sort => $config) {
                $toArray['sort'][$sort] = $config;
            }
        }

        return $this;
    }
}
