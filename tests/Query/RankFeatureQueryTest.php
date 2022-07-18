<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\RankFeatureQuery;
use PHPUnit\Framework\TestCase;

class RankFeatureQueryTest extends TestCase
{
    public function testItBuildTheQuery(): void
    {
        $rankFeatureQuery = new RankFeatureQuery('rank');

        $rankFeatureQuery->setBoost(0.9);

        $this->assertEquals([
            'rank_feature' => [
                'field' => 'rank',
                'boost' => 0.9,
            ],
        ], $rankFeatureQuery->build());
    }
}
