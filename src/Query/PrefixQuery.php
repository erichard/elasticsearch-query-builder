<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class PrefixQuery implements QueryInterface
{
    /** @var string */
    protected $field;

    protected $value;

    /** @var float */
    protected $boost;

    public function __construct(string $field, $value)
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
