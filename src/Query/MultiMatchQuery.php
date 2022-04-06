<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasOperator;

class MultiMatchQuery implements QueryInterface
{
    use HasOperator;

    /**
     * @param mixed[]|string[] $fields
     */
    public function __construct(
        protected array $fields,
        protected string $query,
        protected ?string $type = null,
        protected ?string $fuzziness = null,
        ?string $operator = null
    ) {
        $this->operator = $operator;
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

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setFuzziness(string $fuzziness): self
    {
        $this->fuzziness = $fuzziness;

        return $this;
    }

    public function build(): array
    {
        $data = [
            'query' => $this->query,
            'fields' => $this->fields,
        ];

        if ($this->type !== null) {
            $data['type'] = $this->type;
        }

        if ($this->fuzziness !== null) {
            $data['fuzziness'] = $this->fuzziness;
        }

        $this->buildOperatorTo($data);

        return [
            'multi_match' => $data,
        ];
    }
}
