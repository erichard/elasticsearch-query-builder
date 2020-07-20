<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class TermQuery implements QueryInterface
{
    /** @var string */
    protected $field;

    /** @var mixed */
    protected $value;

    public function __construct(string $field = null, $value = null)
    {
        $this->field = $field;
        $this->value = $value;
    }

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
