<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class ExistsQuery implements QueryInterface
{

    /** @var string */
    protected $field;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function build(): array
    {
        if (null === $this->field) {
            throw new QueryException('You need to call setField() on' . __CLASS__);
        }

        return [
            'exists' => [
                'field' => $this->field
            ],
        ];
    }
}
