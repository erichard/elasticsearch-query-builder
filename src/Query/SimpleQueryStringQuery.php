<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasBoost;
use Erichard\ElasticQueryBuilder\Features\HasMinimumShouldMatch;

class SimpleQueryStringQuery implements QueryInterface
{
    use HasBoost;
    use HasMinimumShouldMatch;

    /**
     * @param mixed[]|string[] $fields
     */
    public function __construct(
        protected array $fields,
        protected string $query,
        private ?string $flags = null,
        private ?bool $fuzzyTranspositions = null,
        private ?int $fuzzyMaxExpansions = null,
        private ?int $fuzzyPrefixLength = null,
        ?string $minimumShouldMatch = null,
        private ?string $defaultOperator = null,
        private ?string $analyzer = null,
        private ?bool $lenient = null,
        private ?string $quoteFieldSuffix = null,
        private ?bool $analyzeWildCard = null,
        private ?bool $autoGenerateSynonymsPhraseQuery = null,
        protected array $params = [],
    ) {
        $this->minimumShouldMatch = $minimumShouldMatch;
    }

    public function setFlags(string|null $flags): self
    {
        $this->flags = $flags;

        return $this;
    }

    public function setFuzzyTranspositions(bool|null $fuzzyTranspositions): self
    {
        $this->fuzzyTranspositions = $fuzzyTranspositions;

        return $this;
    }

    public function setFuzzyMaxExpansions(int|null $fuzzyMaxExpansions): self
    {
        $this->fuzzyMaxExpansions = $fuzzyMaxExpansions;

        return $this;
    }

    public function setFuzzyPrefixLength(int|null $fuzzyPrefixLength): self
    {
        $this->fuzzyPrefixLength = $fuzzyPrefixLength;

        return $this;
    }

    public function setDefaultOperator(string|null $defaultOperator): self
    {
        $this->defaultOperator = $defaultOperator;

        return $this;
    }

    public function setAnalyzer(string|null $analyzer): self
    {
        $this->analyzer = $analyzer;

        return $this;
    }

    public function setLenient(bool|null $lenient): self
    {
        $this->lenient = $lenient;

        return $this;
    }

    public function setQuoteFieldSuffix(string|null $quoteFieldSuffix): self
    {
        $this->quoteFieldSuffix = $quoteFieldSuffix;

        return $this;
    }

    public function setAnalyzeWildCard(bool|null $analyzeWildCard): self
    {
        $this->analyzeWildCard = $analyzeWildCard;

        return $this;
    }

    public function setAutoGenerateSynonymsPhraseQuery(bool|null $autoGenerateSynonymsPhraseQuery): self
    {
        $this->autoGenerateSynonymsPhraseQuery = $autoGenerateSynonymsPhraseQuery;

        return $this;
    }

    public function setFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    public function build(): array
    {
        $data = [
            'query' => $this->query,
            'fields' => $this->fields,
        ];
        if (null !== $this->flags) {
            $data['flags'] = $this->flags;
        }
        if (null !== $this->fuzzyTranspositions) {
            $data['fuzzy_transpositions'] = $this->fuzzyTranspositions;
        }

        if (null !== $this->fuzzyMaxExpansions) {
            $data['fuzzy_max_expansions'] = $this->fuzzyMaxExpansions;
        }

        if (null !== $this->fuzzyPrefixLength) {
            $data['fuzzy_prefix_length'] = $this->fuzzyPrefixLength;
        }

        if (null !== $this->defaultOperator) {
            $data['default_operator'] = $this->defaultOperator;
        }

        if (null !== $this->analyzer) {
            $data['analyzer'] = $this->analyzer;
        }

        if (null !== $this->lenient) {
            $data['lenient'] = $this->lenient;
        }

        if (null !== $this->quoteFieldSuffix) {
            $data['quote_field_suffix'] = $this->quoteFieldSuffix;
        }

        if (null !== $this->analyzeWildCard) {
            $data['analyze_wildcard'] = $this->analyzeWildCard;
        }
        if (null !== $this->autoGenerateSynonymsPhraseQuery) {
            $data['auto_generate_synonyms_phrase_query'] = $this->autoGenerateSynonymsPhraseQuery;
        }

        $this->buildMinimumShouldMatchTo($data);
        $this->buildBoostTo($data);

        $build = $this->params;
        $build['simple_query_string'] = $data;

        return $build;
    }
}
