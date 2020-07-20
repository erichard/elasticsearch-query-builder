<?php

namespace Erichard\ElasticQueryBuilder\Query;

interface QueryInterface
{
    public function build(): array;
}
