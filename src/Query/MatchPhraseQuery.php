<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

class MatchPhraseQuery extends AbstractMatchQuery
{
    public function getQueryName(): string
    {
        return 'match_phrase';
    }
}
