<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Options;

use Erichard\ElasticQueryBuilder\Contracts\BuildsArray;

class SourceScript implements BuildsArray
{
    public function __construct(protected string $script)
    {
    }

    public function setScript(string $script): self
    {
        $this->script = $script;

        return $this;
    }

    public function build(): array
    {
        return [
            'script' => [
                'source' => $this->script,
            ],
        ];
    }

    public function getScript(): string
    {
        return $this->script;
    }
}
