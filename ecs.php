<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return function (ECSConfig $ecsConfig): void {
    $ecsConfig->sets([SetList::PSR_12, SetList::SYMPLIFY, SetList::COMMON, SetList::CLEAN_CODE, SetList::SYMFONY]);
    $ecsConfig->paths([__DIR__.'/src', __DIR__.'/tests', __DIR__.'/ecs.php']);
    $ecsConfig->rules([IsNullFixer::class]);
    $ecsConfig->parallel();
};
