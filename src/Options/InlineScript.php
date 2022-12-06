<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Options;

use Erichard\ElasticQueryBuilder\Contracts\BuildsArray;

class InlineScript implements BuildsArray
{
    public function __construct(
        private string $script
    ) {}

    public function setScript(string $script): self
    {
        $this->script = $script;

        return $this;
    }

    public function getScript(): string
    {
        return $this->script;
    }

    public function build(): array
    {
        return [
            'script' => [
                'inline' => $this->script,
                'lang' => 'painless',
            ],
        ];
    }
}
