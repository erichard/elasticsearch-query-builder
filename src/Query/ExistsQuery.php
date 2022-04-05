<?php

declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Query;

use Erichard\ElasticQueryBuilder\Contracts\QueryInterface;
use Erichard\ElasticQueryBuilder\Features\HasField;

class ExistsQuery implements QueryInterface
{
    use HasField;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function build(): array
    {
        return [
            'exists' => [
                'field' => $this->field,
            ],
        ];
    }
}
