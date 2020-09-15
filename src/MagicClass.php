<?php

declare(strict_types=1);

namespace Test;

class MagicClass {
    public function __call(string $name, array $arguments) {
        if ($name === 'my_magic_method') {
            return $this->my_real_method();
        }

        return "method $name does not exist";
    }

    /**
     * Implementation
     */
    private function my_real_method(): string {
        return 'hello!';
    }
}
