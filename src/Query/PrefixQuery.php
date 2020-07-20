<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class PrefixQuery implements QueryInterface
{
    protected $field;
    protected $value;
    protected $boost;

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

    public function setBoost($boost)
    {
        $this->boost = $boost;

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

        $value = $this->value;

        if (null !== $this->boost) {
            $value = [
                'value' => $this->value,
                'boost' => $this->boost,
            ];
        }

        return [
            'prefix' => [
                $this->field => $value,
            ],
        ];
    }
}
