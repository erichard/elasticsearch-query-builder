<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Options;

use Erichard\ElasticQueryBuilder\Contracts\BuildsArray;
use Erichard\ElasticQueryBuilder\Features\HasCollapse;
use Erichard\ElasticQueryBuilder\Features\HasSorting;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html#request-body-search-inner-hits
 */
class InnerHit implements BuildsArray
{
    use HasSorting;
    use HasCollapse;

    public function __construct(
        protected string $name,
        /**
         * The maximum number of hits to return per inner_hits. By default the top three matching hits are returned.
         */
        protected ?int $size = null,
        /**
         * The offset from where the first hit to fetch for each inner_hits in the returned regular search hits.
         */
        protected ?string $from = null
    ) {
    }

    public function build(): array
    {
        // Build optional options. (filter will remove null values)
        $array = array_filter([
            'from' => $this->from,
            'size' => $this->size,
            'name' => $this->name,
        ]);
        $this->buildSortTo($array);
        $this->buildCollapseTo($array);

        return $array;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    public function setFrom(?string $from): void
    {
        $this->from = $from;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
