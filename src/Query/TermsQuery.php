<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class TermsQuery implements QueryInterface
{
    /** @var string */
    protected $field;

    /** @var array */
    protected $value;

    public function __construct(string $field = null, array $value = [])
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function setValues(array $value): self
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
            throw new QueryException('You need to call setValues() on'.__CLASS__);
        }

        return [
            'terms' => [
                $this->field => $this->values,
            ],
        ];
    }
}
