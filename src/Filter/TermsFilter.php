<?php

namespace Erichard\ElasticQueryBuilder\Filter;

class TermsFilter extends TermFilter
{
    public function build(): array
    {
        return [
            'terms' => [
                $this->field => $this->value,
            ],
        ];
    }
}
