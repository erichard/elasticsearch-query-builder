<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\QueryException;

class TermFilter extends Filter
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

    public function build(): array
    {
        if (null === $this->field) {
            throw new QueryException('You need to call setField() on'.__CLASS__);
        }
        if (null === $this->value) {
            throw new QueryException('You need to call setValue() on'.__CLASS__);
        }

        return [
            'term' => [
                $this->field => $this->value,
            ],
        ];
    }
}
