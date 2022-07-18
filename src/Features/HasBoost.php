<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

trait HasBoost
{
    protected ?float $boost = null;

    public function setBoost(?float $boost): self
    {
        $this->boost = $boost;

        return $this;
    }

    public function buildBoostTo(array &$array): self
    {
        if (null === $this->boost) {
            return $this;
        }

        $array['boost'] = $this->boost;

        return $this;
    }

    public function getBoost(): ?float
    {
        return $this->boost;
    }
}
