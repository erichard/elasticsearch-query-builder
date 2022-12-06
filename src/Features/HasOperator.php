<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

trait HasOperator
{
    protected ?string $operator = null;

    public function setOperator(?string $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function buildOperatorTo(array &$array): self
    {
        if (null === $this->operator) {
            return $this;
        }

        $array['operator'] = $this->operator;

        return $this;
    }

    public function getOperator(): ?string
    {
        return $this->operator;
    }
}
