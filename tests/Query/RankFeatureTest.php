<?php

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;
use Erichard\ElasticQueryBuilder\Query\Query;
use Erichard\ElasticQueryBuilder\Query\RankFeatureQuery;
use PHPUnit\Framework\TestCase;

class RankFeatureTest extends TestCase
{
    public function test_it_build_the_query()
    {
        $rankFeatureQuery = new RankFeatureQuery('rank');

        $this->assertEquals([
            'rank_feature' => [
                'field' => 'rank',
            ]
        ], $rankFeatureQuery->build());
    }

    public function test_it_build_the_query_with_boost()
    {
        $rankFeatureQuery = new RankFeatureQuery('rank', 0.9);

        $this->assertEquals([
            'rank_feature' => [
                'field' => 'rank',
                'boost' => 0.9,
            ]
        ], $rankFeatureQuery->build());
    }

    public function test_it_builds_the_query_from_setters()
    {
        $rankFeatureQuery = new RankFeatureQuery();

        $rankFeatureQuery->setField('rank')
            ->setBoost(0.9);

        $this->assertEquals([
            'rank_feature' => [
                'field' => 'rank',
                'boost' => 0.9,
            ]
        ], $rankFeatureQuery->build());
    }
}
