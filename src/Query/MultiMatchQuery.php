<?php

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\QueryException;

class MultiMatchQuery implements QueryInterface
{
    /** @var array|string[] */
    protected $fields;

    protected $query;

    /** @var string */
    protected $type;

    protected $fuzziness;

    public function __construct(array $fields, $query)
    {
        $this->fields = $fields;
        $this->query = $query;
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
        if (null === $this->fields) {
            throw new QueryException('You need to call setFields() on'.__CLASS__);
        }

        if (null === $this->query) {
            throw new QueryException('You need to call setQuery() on'.__CLASS__);
        }

        $query = [
            'multi_match' => [
                'query' => $this->query,
                'fields' => $this->fields,
            ],
        ];

        if (null !== $this->type) {
            $query['multi_match']['type'] = $this->type;
        }

        if (null !== $this->fuzziness) {
            $query['multi_match']['fuzziness'] = $this->fuzziness;
        }

        return $query;
    }
}
