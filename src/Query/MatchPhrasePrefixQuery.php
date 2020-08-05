<?php

namespace Erichard\ElasticQueryBuilder\Query;

class MatchPhrasePrefixQuery extends AbstractMatchQuery
{
    public function getQueryName(): string
    {
        return 'match_phrase_prefix';
    }
}
