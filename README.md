ElasticSearch Query Builder
===========================

![img](https://img.shields.io/badge/phpstan-8-green)
![php](https://img.shields.io/badge/php-8.0-brightgreen)


This is a PHP library which helps you build query for an ElasticSearch client by using a fluent interface.

WARNING: This branch contains the next 3.x release. Check the [corresponding issue](https://github.com/erichard/elasticsearch-query-builder/issues/7) for the roadmap.

Installation
------------

```bash
composer require erichard/elasticsearch-query-builder "^3.0@beta"
```

Usage
-----

```php

use Erichard\ElasticQueryBuilder\QueryBuilder;
use Erichard\ElasticQueryBuilder\Aggregation\Aggregation;
use Erichard\ElasticQueryBuilder\Filter\Filter;

$qb = new QueryBuilder();

$qb
    ->setIndex('app')
    ->setSize(10)
;

// Add an aggregation
$qb->addAggregation(Aggregation::terms('agg_name', 'my_field'));
$qb->addAggregation(Aggregation::terms('agg_name_same_as_field'));

// Set query
$qb->setQuery(Query::terms('field', 'value'));

// I am using a client from elasticsearch/elasticsearch here
$results = $client->search($qb->build());
```

with PHP 8.1 you can use named arguments like this:

```php
$query = new BoolQuery(must: [
    new RangeQuery(
        field: 'price',
        gte: 100
    ),
    new RangeQuery(
        field: 'stock',
        gte: 10
    ),
]);
```

or with the factory

```php
$query = Query::bool(must: [
    Query::range(
        field: 'price',
        gte: 100
    ),
    Query::range(
        field: 'stock',
        gte: 10
    ),
]);
```

Contribution
------------

- Use PHPCS fixer and PHPStan
  - `composer lint`
- Update tests (PHPUnit)
  - `composer test`

