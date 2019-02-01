<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\QueryException;

class MultiMatchFilter extends Filter
{
    protected $fields;
    protected $query;
    protected $type;
    protected $fuzziness;

    public function setFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function setQuery(string $query)
    {
        $this->query = $query;

        return $this;
    }

    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    public function setFuzziness(string $fuzziness)
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
