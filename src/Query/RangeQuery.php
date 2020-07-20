<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class RangeQuery implements QueryInterface
{
    protected $field;
    protected $lt;
    protected $gt;
    protected $lte;
    protected $gte;

    public function setField(string $field)
    {
        $this->field = $field;

        return $this;
    }

    public function gt($value)
    {
        $this->gt = $value;

        return $this;
    }

    public function lt($value)
    {
        $this->lt = $value;

        return $this;
    }

    public function gte($value)
    {
        $this->gte = $value;

        return $this;
    }

    public function lte($value)
    {
        $this->lte = $value;

        return $this;
    }

    public function build(): array
    {
        $query = [];

        if (null !== $this->gt) {
            $query['gt'] = $this->gt;
        }
        if (null !== $this->lt) {
            $query['lt'] = $this->lt;
        }
        if (null !== $this->gte) {
            $query['gte'] = $this->gte;
        }
        if (null !== $this->lte) {
            $query['lte'] = $this->lte;
        }

        if (empty($query)) {
            throw new QueryException('Empty Query');
        }

        return [
            'range' => [
                $this->field => $query,
            ],
        ];
    }
}
