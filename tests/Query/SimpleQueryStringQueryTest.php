<?php

declare(strict_types=1);

namespace Tests\Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Query\SimpleQueryStringQuery;
use PHPUnit\Framework\TestCase;

class SimpleQueryStringQueryTest extends TestCase
{
    public function testItBuildTheQuery(): void
    {
        $query = new SimpleQueryStringQuery(
            ['subject', 'body'],
            '~brown fox',
            'ALL',
            true,
            50,
            0,
            "1%",
            "or",
            "standard",
            false,
            "",
            false,
            true

        );
        $this->assertEquals([
                'simple_query_string' =>
                    [
                        'query' => '~brown fox',
                        'fields' =>
                            [
                                'subject',
                                'body',
                            ],
                        'flags' => 'ALL',
                        'fuzzy_transpositions' => true,
                        'fuzzy_max_expansions' => 50,
                        'fuzzy_prefix_length' => 0,
                        'default_operator' => 'or',
                        'analyzer' => 'standard',
                        'lenient' => false,
                        'quote_field_suffix' => '',
                        'analyze_wildcard' => false,
                        'auto_generate_synonyms_phrase_query' => true,
                        'minimum_should_match' => '1%',
                    ],
        ], $query->build());
    }

    public function testItBuildTheQueryWithAFuzziness(): void
    {
        $query = new SimpleQueryStringQuery(
            ['subject', 'body'],
            '~brown fox',
            'ALL',
            true,
            50,
            0,
            "1%",
            "or",
            "standard",
            false,
            "",
            false,
            true

        );
        $query->setDefaultOperator('and');
        $this->assertEquals([
            'simple_query_string' =>
                [
                    'query' => '~brown fox',
                    'fields' =>
                        [
                            'subject',
                            'body',
                        ],
                    'flags' => 'ALL',
                    'fuzzy_transpositions' => true,
                    'fuzzy_max_expansions' => 50,
                    'fuzzy_prefix_length' => 0,
                    'default_operator' => 'and',
                    'analyzer' => 'standard',
                    'lenient' => false,
                    'quote_field_suffix' => '',
                    'analyze_wildcard' => false,
                    'auto_generate_synonyms_phrase_query' => true,
                    'minimum_should_match' => '1%',
                ],
        ], $query->build());
    }

    public function testItBuildTheQueryWithBoost(): void
    {
        $query = new SimpleQueryStringQuery(
            ['subject', 'body'],
            '~brown fox',
            'ALL',
            true,
            50,
            0,
            "1%",
            "or",
            "standard",
            false,
            "",
            false,
            true

        );
        $query->setBoost(3);

        $this->assertEquals([
                'simple_query_string' =>
                    [
                        'query' => '~brown fox',
                        'fields' =>
                            [
                                'subject',
                                'body',
                            ],
                        'flags' => 'ALL',
                        'fuzzy_transpositions' => true,
                        'fuzzy_max_expansions' => 50,
                        'fuzzy_prefix_length' => 0,
                        'default_operator' => 'or',
                        'analyzer' => 'standard',
                        'lenient' => false,
                        'quote_field_suffix' => '',
                        'analyze_wildcard' => false,
                        'auto_generate_synonyms_phrase_query' => true,
                        'minimum_should_match' => '1%',
                        'boost' => 3,
                    ],
        ], $query->build()); 
    }
}
