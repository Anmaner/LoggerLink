<?php

namespace App\UseCases\FileGenerator;

use App\UseCases\FileGenerator\TXTFileGenerator;
use SimpleXMLElement;

class FileGeneratorFactory
{
    public static function create($fileType)
    {
        switch ($fileType) {
            case('txt'):
                return new TXTFileGenerator();
            case('xml'):
                return new XMLFileGenerator(
                    new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><export></export>')
                );
            case('json'):
                return new JsonFileGenerator();
        }
    }
}
