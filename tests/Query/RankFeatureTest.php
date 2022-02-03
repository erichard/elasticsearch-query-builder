<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\RankFeatureQuery;
use PHPUnit\Framework\TestCase;

class RankFeatureTest extends TestCase
{
    public function test_it_build_the_query()
    {
        $rankFeatureQuery = new RankFeatureQuery('rank');

        $rankFeatureQuery->setBoost(0.9);

        $this->assertEquals([
            'rank_feature' => [
                'field' => 'rank',
                'boost' => 0.9,
            ]
        ], $rankFeatureQuery->build());
    }
}
