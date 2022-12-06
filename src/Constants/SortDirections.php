<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Constants;

final class SortDirections
{
    /**
     * @var string
     */
    public const ASC = 'asc';

    /**
     * @var string
     */
    public const DESC = 'desc';

    public static function getMap(): array
    {
        return [
            self::ASC => self::ASC,
            self::DESC => self::DESC,
        ];
    }
}
