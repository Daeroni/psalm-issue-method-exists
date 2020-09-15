<?php

declare(strict_types=1);

namespace Test;

use Psalm\CodeLocation;
use Psalm\Context;
use Psalm\StatementsSource;

use Psalm\Plugin\Hook\MethodExistenceProviderInterface;
use Psalm\Plugin\Hook\MethodParamsProviderInterface;
use Psalm\Plugin\Hook\MethodReturnTypeProviderInterface;
use Psalm\Plugin\Hook\MethodVisibilityProviderInterface;

use Psalm\Type\Atomic\TString;
use Psalm\Type\Union;

class MagicMethodPsalmPlugin implements MethodExistenceProviderInterface, MethodReturnTypeProviderInterface, MethodParamsProviderInterface, MethodVisibilityProviderInterface {
    /**
     * @see MethodExistenceProviderInterface::getClassLikeNames()
     *
     * @return array<class-string>
     */
    public static function getClassLikeNames(): array {
        return [
            MagicClass::class,
        ];
    }

    /**
     * @see MethodExistenceProviderInterface::doesMethodExist()
     *
     * @return ?bool
     */
    public static function doesMethodExist(
        string $fq_classlike_name,
        string $method_name_lowercase,
        ?StatementsSource $source = null,
        ?CodeLocation $code_location = null
    ): ?bool {
        switch ($fq_classlike_name) {
            case MagicClass::class:
                switch ($method_name_lowercase) {
                    case 'my_magic_method':
                        return true;
                    /**
                     * What's the difference here?
                     *
                     * 3.14.2: UndefinedMethod for undefined methods (good)
                     * 3.15:   UndefinedMethod for ALL magic methods (bad)
                     */
                    case '__call':
                        return false;
                }
        }

        return null;
    }

    /**
     * @see MethodParamsProviderInterface::getMethodParams()
     *
     * @param  array<\PhpParser\Node\Arg>    $call_args
     *
     * @return ?array<int, \Psalm\Storage\FunctionLikeParameter>
     */
    public static function getMethodParams(
        string $fq_classlike_name,
        string $method_name_lowercase,
        ?array $call_args = null,
        ?StatementsSource $statements_source = null,
        ?Context $context = null,
        ?CodeLocation $code_location = null
    ): ?array {
        switch ($fq_classlike_name) {
            case MagicClass::class:
                switch ($method_name_lowercase) {
                    case 'my_magic_method':
                        return [];
                }
        }

        return null;
    }

    /**
     * @see MethodReturnTypeProviderInterface::getMethodReturnType()
     *
     * @param  array<\PhpParser\Node\Arg> $call_args
     * @param  ?array<Union> $template_type_parameters
     *
     * @return ?Union
     */
    public static function getMethodReturnType(
        StatementsSource $source,
        string $fq_classlike_name,
        string $method_name_lowercase,
        array $call_args,
        Context $context,
        CodeLocation $code_location,
        ?array $template_type_parameters = null,
        ?string $called_fq_classlike_name = null,
        ?string $called_method_name_lowercase = null
    ): ?Union {
        switch ($fq_classlike_name) {
            case MagicClass::class:
                switch ($method_name_lowercase) {
                    case 'my_magic_method':
                        return new Union([new TString]);
                }
        }

        return null;
    }

    /**
     * @see MethodVisibilityProviderInterface::isMethodVisible()
     *
     * @return ?bool
     */
    public static function isMethodVisible(
        StatementsSource $source,
        string $fq_classlike_name,
        string $method_name_lowercase,
        Context $context,
        ?CodeLocation $code_location = null
    ): ?bool {
        switch ($fq_classlike_name) {
            case MagicClass::class:
                switch ($method_name_lowercase) {
                    case 'my_magic_method':
                        return true;
                }
        }

        return null;
    }
}
