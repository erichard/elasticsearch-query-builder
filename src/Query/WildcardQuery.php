<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasField;

class WildcardQuery implements QueryInterface
{
    use HasField;

    public function __construct(
        string $field,
        protected string $value,
        protected array $params = [],
    ) {
        $this->field = $field;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public static function escapeWildcards(string $string): string
    {
        $escapeChars = ['*', '?'];
        foreach ($escapeChars as $escapeChar) {
            $string = str_replace($escapeChar, '\\'.$escapeChar, $string);
        }

        return $string;
    }

    public function build(): array
    {
        $build = $this->params;
        $build['wildcard'] = [
            $this->field => $this->value,
        ];

        return $build;
    }
}
