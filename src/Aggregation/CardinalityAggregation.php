<?php

namespace Erichard\ElasticQueryBuilder\Aggregation;

class CardinalityAggregation extends MetricAggregation
{
	private $precisionThreshold;

	public function setPrecisionThreshold($precisionThreshold)
	{
		$this->precisionThreshold = $precisionThreshold;
	}

    public function getMetricName(): string
    {
        return 'cardinality';
    }

    public function build(): array
    {
    	$build = parent::build();

    	if (null !== $this->precisionThreshold) {
    		$build['cardinality']['precision_threshold'] = $this->precisionThreshold;
    	}

    	return $build;
    }
}
