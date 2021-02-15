<?php

namespace src\Shared\Application\Transformers;

abstract class AbstractTransformer
{

    abstract protected function build(): array;

    public function get(): array
    {
        return $this->build();
    }
}
