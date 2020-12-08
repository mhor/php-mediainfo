<?php

use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [__DIR__.'/src', __DIR__.'/tests']);
    $parameters->set(Option::SETS, [
        SetList::PSR_12,
    ]);

    $services = $containerConfigurator->services();
    $services->set(ConcatSpaceFixer::class)->call('configure', [[
        'spacing' => 'none',
    ]]);

    $services->set(BinaryOperatorSpacesFixer::class)->call('configure', [[
        'align_double_arrow' => true,
    ]]);
};
