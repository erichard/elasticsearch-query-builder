<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

use Erichard\ElasticQueryBuilder\Options\Collapse;

trait HasCollapse
{
    protected ?Collapse $collapse = null;

    /**
     * Adds field collapsing.
     *
     * @param string|Collapse $collapseByField collapse by given field or provide collapse object
     *
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html#request-body-search-collapse
     */
    public function setCollapse(string|Collapse $collapseByField): self
    {
        $this->collapse = is_string($collapseByField)
            ? new Collapse($collapseByField)
            : $collapseByField;

        return $this;
    }

    public function getCollapse(): ?Collapse
    {
        return $this->collapse;
    }

    /**
     * Adds collapse to array if field collapsing is set.
     */
    protected function buildCollapseTo(array &$toArray): self
    {
        if ($this->collapse !== null) {
            $toArray['collapse'] = $this->collapse->build();
        }

        return $this;
    }
}
