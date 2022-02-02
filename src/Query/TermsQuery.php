<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class TermsQuery implements QueryInterface
{
    /** @var string */
    protected $field;

    /** @var array */
    protected $values = [];

    public function __construct(string $field = null, ?array $values = [])
    {
        $this->field = $field;
        $this->values = $values;
    }

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function setValues(array $values): self
    {
        $this->values = $values;

        return $this;
    }

    public function build(): array
    {
        if (null === $this->field) {
            throw new QueryException('You need to call setField() on'.__CLASS__);
        }
        if (empty($this->values)) {
            throw new QueryException('You need to call setValues() on'.__CLASS__);
        }

        return [
            'terms' => [
                $this->field => $this->values,
            ],
        ];
    }
}
