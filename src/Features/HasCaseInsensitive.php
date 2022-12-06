<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

trait HasCaseInsensitive
{
    protected ?bool $caseInsensitive = null;

    public function setCaseInsensitive(?bool $caseInsensitive): self
    {
        $this->caseInsensitive = $caseInsensitive;

        return $this;
    }

    public function buildCaseInsensitiveTo(array &$array): self
    {
        if (null === $this->caseInsensitive) {
            return $this;
        }

        $array['case_insensitive'] = $this->caseInsensitive;

        return $this;
    }

    public function getCaseInsensitive(): ?bool
    {
        return $this->caseInsensitive;
    }
}
