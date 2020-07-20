<?php

namespace Erichard\ElasticQueryBuilder\Query;

class GeoDistanceQuery implements QueryInterface
{
    private $distance;
    private $pinLocation;
    private $field;

    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    public function setPinLocation($pinLocation)
    {
        $this->pinLocation = $pinLocation;

        return $this;
    }

    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    public function build(): array
    {
        return [
            'geo_distance' => [
                'distance' => $this->distance,
                $this->field ? $this->field : 'geolocation' => $this->pinLocation,
            ],
        ];
    }
}
