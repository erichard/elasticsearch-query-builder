<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

trait HasFormat
{
    protected ?string $format = null;

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function buildFormatTo(array &$array): self
    {
        if (null === $this->format) {
            return $this;
        }

        $array['format'] = $this->format;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }
}
