<?php

namespace App\UseCases\FileGenerator;

interface FileGeneratorInterface
{
    public function generate(array $items, array $userFields): string;
}
