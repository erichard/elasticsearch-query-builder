<?php

namespace Erichard\ElasticQueryBuilder\Query;

class TermsQuery extends TermQuery
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
