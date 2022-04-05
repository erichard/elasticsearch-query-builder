<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Options;

use Erichard\ElasticQueryBuilder\Contracts\BuildsArray;

class Field implements BuildsArray
{
    public function __construct(protected string $value)
    {
    }

    public function build(): array
    {
        return [
            'field' => $this->value,
        ];
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}
