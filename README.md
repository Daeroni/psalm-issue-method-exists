# psalm-issue-method-exists

1. `composer install` # version `3.14.2`
2. `vendor/bin/psalm test.php`
```
ERROR: UndefinedMethod - test.php:15:24 - Method Test\MagicClass::my_mistyped_undefined_magic_method does not exist (see https://psalm.dev/022)
print (string)$object->my_mistyped_undefined_magic_method() . PHP_EOL;

------------------------------
1 errors found
------------------------------
```

3. `composer require vimeo/psalm dev-master#9935f64` # or `3.15`
4. `vendor/bin/psalm test.php`

```
ERROR: UndefinedMethod - test.php:13:16 - Method Test\MagicClass::my_magic_method does not exist (see https://psalm.dev/022)
print $object->my_magic_method() . PHP_EOL;

ERROR: UndefinedMethod - test.php:15:24 - Method Test\MagicClass::my_mistyped_undefined_magic_method does not exist (see https://psalm.dev/022)
print (string)$object->my_mistyped_undefined_magic_method() . PHP_EOL;

------------------------------
2 errors found
------------------------------
```
