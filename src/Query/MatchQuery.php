<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

class MatchQuery extends AbstractMatchQuery
{
    public function getQueryName(): string
    {
        return 'match';
    }
}
