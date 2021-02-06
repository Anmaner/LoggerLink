<?php

namespace App\UseCases\FileGenerator;

use App\UseCases\FileGenerator\TXTFileGenerator;

class FileGeneratorFactory
{
    public static function create($fileType)
    {
        switch ($fileType) {
            case('txt'):
                return new TXTFileGenerator();
        }
    }
}
