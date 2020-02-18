<?php

namespace Erichard\ElasticQueryBuilder\Filter;

class GeoDistanceFilter extends Filter
{
    protected $distance;
    protected $pinLocation;
    protected $field;

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
