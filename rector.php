<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Strict\Rector\BooleanNot\BooleanInBooleanNotRuleFixerRector;
use Rector\Strict\Rector\Ternary\BooleanInTernaryOperatorRuleFixerRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;


return static function (ContainerConfigurator $containerConfigurator): void {

    // get parameters
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_80);

    // Define what rule sets will be applied
    $containerConfigurator->import(LevelSetList::UP_TO_PHP_80);

    $containerConfigurator->import(SetList::CODE_QUALITY);
    $containerConfigurator->import(SetList::CODING_STYLE);

    $services = $containerConfigurator->services();
    $services->set(AddVoidReturnTypeWhereNoReturnRector::class);
    $services->set(BooleanInBooleanNotRuleFixerRector::class)->configure([
        BooleanInTernaryOperatorRuleFixerRector::TREAT_AS_NON_EMPTY => false,
    ]);

};
