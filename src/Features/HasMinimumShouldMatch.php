<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

trait HasMinimumShouldMatch
{
    protected ?string $minimumShouldMatch = null;

    public function setMinimumShouldMatch(?string $minimumShouldMatch): self
    {
        $this->minimumShouldMatch = $minimumShouldMatch;

        return $this;
    }

    public function buildMinimumShouldMatchTo(array &$array): self
    {
        if (null === $this->minimumShouldMatch) {
            return $this;
        }

        $array['minimum_should_match'] = $this->minimumShouldMatch;

        return $this;
    }

    public function getMinimumShouldMatch(): ?string
    {
        return $this->minimumShouldMatch;
    }
}
