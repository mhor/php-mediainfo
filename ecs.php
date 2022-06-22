<?php

use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    $parameters = $ecsConfig->parameters();
    $parameters->set(Option::PATHS, [__DIR__.'/src', __DIR__.'/tests']);

    $ecsConfig->sets([SetList::PSR_12]);

    $services = $ecsConfig->services();
    $services->set(ConcatSpaceFixer::class)->call('configure', [[
        'spacing' => 'none',
    ]]);

    $services->set(BinaryOperatorSpacesFixer::class)->call('configure', [[
        'operators' => ['=>' => 'align'],
    ]]);
};
