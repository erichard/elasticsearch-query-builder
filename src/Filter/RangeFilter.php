<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\QueryException;

class RangeFilter extends Filter
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
        $filter = [];

        if (null !== $this->gt) {
            $filter['gt'] = $this->gt;
        }
        if (null !== $this->lt) {
            $filter['lt'] = $this->lt;
        }
        if (null !== $this->gte) {
            $filter['gte'] = $this->gte;
        }
        if (null !== $this->lte) {
            $filter['lte'] = $this->lte;
        }

        if (empty($filter)) {
            throw new QueryException('Empty filter');
        }

        return [
            'range' => [
                $this->field => $filter,
            ],
        ];
    }
}
