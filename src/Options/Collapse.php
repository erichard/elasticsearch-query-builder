<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Options;

use Erichard\ElasticQueryBuilder\Contracts\BuildsArray;
use Erichard\ElasticQueryBuilder\Features\HasField;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html#_expand_collapse_results
 */
class Collapse implements BuildsArray
{
    use HasField;

    /**
     * @var array<InnerHit>
     *
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-body.html#request-body-search-inner-hits
     */
    protected array $innerHits = [];

    /**
     * The number of concurrent requests allowed to retrieve the inner_hits` per group.
     */
    protected ?int $maxConcurrentSearchers = null;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function addInnerHit(InnerHit $hit): self
    {
        $this->innerHits[] = $hit;

        return $this;
    }

    public function build(): array
    {
        $result = [
            'field' => $this->field,
        ];

        if (null !== $this->maxConcurrentSearchers) {
            $result['max_concurrent_group_searches'] = $this->maxConcurrentSearchers;
        }

        if (false === empty($this->innerHits)) {
            $result['inner_hits'] = array_map(fn (InnerHit $hit) => $hit->build(), $this->innerHits);
        }

        return $result;
    }

    public function setMaxConcurrentSearchers(int $maxConcurrentSearchers): self
    {
        $this->maxConcurrentSearchers = $maxConcurrentSearchers;

        return $this;
    }
}
