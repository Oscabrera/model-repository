<?php

declare(strict_types=1);

return [
    'preset' => 'default',
    'remove' => [
        SlevomatCodingStandard\Sniffs\Classes\SuperfluousTraitNamingSniff::class,
        NunoMaduro\PhpInsights\Domain\Insights\ForbiddenTraits::class,
        PHP_CodeSniffer\Standards\Generic\Sniffs\Files\OneTraitPerFileSniff::class,
        NunoMaduro\PhpInsights\Domain\Insights\ForbiddenNormalClasses::class,
        SlevomatCodingStandard\Sniffs\Classes\SuperfluousExceptionNamingSniff::class,
        SlevomatCodingStandard\Sniffs\Classes\SuperfluousInterfaceNamingSniff::class,
        PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterNotSniff::class,
        PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\BacktickOperatorSniff::class,
        SlevomatCodingStandard\Sniffs\TypeHints\DisallowMixedTypeHintSniff::class,
        SlevomatCodingStandard\Sniffs\Commenting\InlineDocCommentDeclarationSniff::class,
    ],
    'config' => [
        PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff::class => [
            'lineLimit' => 120,
            'absoluteLineLimit' => 120,
        ],
        SlevomatCodingStandard\Sniffs\Functions\FunctionLengthSniff::class => [
            'maxLinesLength' => 30,
        ],
        NunoMaduro\PhpInsights\Domain\Insights\CyclomaticComplexityIsHigh::class => [
            'maxComplexity' => 7,
        ],
        NunoMaduro\PhpInsights\Domain\Insights\ForbiddenGlobals::class => [
            'exclude' => [
                'ci-scripts/phpMD/run.php',
                'ci-scripts/phpStan/run.php',
                'ci-scripts/Pint/run.php',
            ],
        ],
    ],
];
