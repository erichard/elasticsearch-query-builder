<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

trait HasField
{
    protected string $field;

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function getField(): string
    {
        return $this->field;
    }
}
