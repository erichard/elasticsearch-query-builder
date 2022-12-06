<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Entities;

class GpsPointEntity
{
    public function __construct(
        public float $lat,
        public float $lon
    ) {}
}
