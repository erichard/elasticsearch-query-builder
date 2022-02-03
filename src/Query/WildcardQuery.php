<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class WildcardQuery implements QueryInterface
{
    /** @var string */
    protected $field;

    protected $value;

    public function __construct(string $field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    public static function escapeWildcards($string): string
    {
        $escapeChars = ['*', '?'];
        foreach ($escapeChars as $escapeChar) {
            $string = str_replace($escapeChar, '\\'.$escapeChar, $string);
        }

        return $string;
    }

    public function build(): array
    {
        if (null === $this->field) {
            throw new QueryException('You need to call setField() on'.__CLASS__);
        }
        if (null === $this->value) {
            throw new QueryException('You need to call setValue() on'.__CLASS__);
        }

        return [
            'wildcard' => [
                $this->field => $this->value,
            ],
        ];
    }
}
