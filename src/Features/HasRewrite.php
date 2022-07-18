<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

trait HasRewrite
{
    protected ?string $rewrite = null;

    public function setRewrite(?string $rewrite): self
    {
        $this->rewrite = $rewrite;

        return $this;
    }

    public function buildRewriteTo(array &$array): self
    {
        if (null === $this->rewrite) {
            return $this;
        }

        $array['rewrite'] = $this->rewrite;

        return $this;
    }

    public function getRewrite(): ?string
    {
        return $this->rewrite;
    }
}
