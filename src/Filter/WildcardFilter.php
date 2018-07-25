<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\QueryException;

class WildcardFilter extends Filter
{
    protected $field;
    protected $value;

    public function setField(string $field)
    {
        $this->field = $field;

        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public static function escapeWildcards($string)
    {
        $escapeChars = [ '*', '?'];
        foreach ($escapeChars as $escapeChar){
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
