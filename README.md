ElasticSearch Query Builder
===========================

![img](https://img.shields.io/badge/phpstan-8-green)
![php](https://img.shields.io/badge/php-8.0-brightgreen)


This is a PHP library which helps you build query for an ElasticSearch client by using a fluent interface.

WARNING: This branch contains the next 3.x release. Check the [corresponding issue](https://github.com/erichard/elasticsearch-query-builder/issues/7) for the roadmap.

Installation
------------

```bash
composer require erichard/elasticsearch-query-builder
```

Usage
-----

```php

use Erichard\ElasticQueryBuilder\QueryBuilder;
use Erichard\ElasticQueryBuilder\Aggregation\Aggregation;
use Erichard\ElasticQueryBuilder\Filter\Filter;

$query = new QueryBuilder();

$query
    ->setType('my_type')
    ->setIndex('app')
    ->setSize(10)
;

// Add an aggregation
$query->addAggregation(Aggregation::terms('agg_name', 'my_field'));
$query->addAggregation(Aggregation::terms('agg_name_same_as_field'));

// Add a filter
$boolFilter = Filter::bool();
$boolFilter->addFilter(Filter::terms('field', 'value'));


$query->addFilter($boolFilter);

// I am using a client from elasticsearch/elasticsearch here
$results = $client->search($query->build());
```

with PHP 8.1 you can do this:

```php
new BoolQuery(should: [
    new RangeQuery(
        field: PriceTermsIndex::PREFIX_OPTION . OptionIds::PERSONS_MAX,
        gte: $this->roomCount
    ),
    new RangeQuery(
        field: PriceTermsIndex::PREFIX_OPTION . OptionIds::PERSONS_MAX,
        gte: $this->roomCount
    ),
])
]
```

Contribution
------------

- Use PHPCS fixer and PHPStan
  - `composer lint`
- Update tests (PHPUnit)
  - `composer test`

