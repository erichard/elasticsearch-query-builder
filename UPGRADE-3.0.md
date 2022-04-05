# Upgrade guide for 3.0


- If you are type-hinting build aggregation use `AbstractAggregation` instead of `Aggregation`
- If you are implementing own `Aggregation` - extend `AbstractAggregation`
- If you are implementing own `Query` (filter) - implement `QueryInterface`

## Rewrite filters to Query

- All files were renamed from `Filter` suffix to `Query`
- namespace has been moved to `Query`
- Move values from `setField` (and other "required" properties) to a constructor of the filter
- Find in your IDE all usages of this text `use Erichard\ElasticQueryBuilder\Filter\`
- Then find all `Filter` definitions and rewrite them to Query
- Remove any lines with `use Erichard\ElasticQueryBuilder\Filter\`
- Use PHPStan to find bugs after refactoring.

## New terminology

- All xxxFilter classes have been renamed to xxxQuery to be more consistent with Elastic terms.
- We are using strict types - ensure that values you are sending are valid.
- Required properties must be defined in constructor. Optional can be in constructor too (for PHP 8.1 - named arguments)

