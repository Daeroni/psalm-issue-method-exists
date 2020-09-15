<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$object = new Test\MagicClass;

/**
 * 3.14.2: No error
 * 3.15:   UndefinedMethod
 */
print $object->my_magic_method() . PHP_EOL;

print $object->my_normal_method() . PHP_EOL;

print (string)$object->my_mistyped_undefined_magic_method() . PHP_EOL;
