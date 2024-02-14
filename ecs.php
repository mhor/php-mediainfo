<?php

use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([__DIR__ . '/src', __DIR__ . '/tests'])
    ->withPreparedSets(true)
    ->withConfiguredRule(ConcatSpaceFixer::class, ['spacing' => 'none',])
    ->withConfiguredRule(BinaryOperatorSpacesFixer::class, ['operators' => ['=>' => 'align']]);