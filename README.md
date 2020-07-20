ElasticSearch Query Builder
===========================

This is a PHP library which helps you build query for an ElasticSearch client by using a fluent interface.

WARNING: This branch contains the next 3.x release. Check the [corresponding issue](https://github.com/erichard/elasticsearch-query-builder/issues/7) for the roadmap.

Installation
------------

```
$ composer require erichard/elasticsearch-query-builder
```

Usage
-----

```

use Erichard\ElasticQueryBuilder\QueryBuilder;
use Erichard\ElasticQueryBuilder\Aggregation\Aggregation;
use Erichard\ElasticQueryBuilder\Filter\Filter;

$qb = new QueryBuilder();

$qb
    ->setType('my_type')
    ->setIndex('app')
    ->setSize(10)
;

// Add an aggregation
$qb->addAggregation(Aggregation::terms('agg_name')->setField('my_field'));

// Add a filter
$boolFilter = Filter::bool();
$boolFilter->addFilter(Filter::terms()->setField('field')->setValue($value));


$qb->addFilter($boolFilter);

// I am using a client from elasticsearch/elasticsearch here
$results = $client->search($qb->getQuery());

```
