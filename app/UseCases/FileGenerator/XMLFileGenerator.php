<?php

namespace App\UseCases\FileGenerator;

use SimpleXMLElement;

class XMLFileGenerator implements FileGeneratorInterface
{
    protected $xml;
    protected $userFields;
    protected $fields = [
        'date',
        'time',
        'ip',
        'provider',
        'country',
        'city',
        'os',
        'browser',
        'from'
    ];

    public function __construct(SimpleXMLElement $xml)
    {
        $this->xml = $xml;
    }

    public function generate(array $items, array $userFields): string
    {
        $this->userFields = $userFields;

        foreach ($items as $num => $item) {
            $this->generateItem($item);
        }

        return $this->xml->asXML();
    }

    protected function generateItem($data): void
    {
        $item = $this->xml->addChild('item');

        foreach ($this->fields as $field) {
            if($this->fieldIsValid($field, $data)) {
                $item->addChild($field, $data[$field]);
            } else {
                $item->addChild($field, '-');
            }
        }
    }

    protected function fieldIsValid($field, $data): bool
    {
        if(!array_key_exists($field, $data)) {
            return false;
        }

        if(empty($data[$field])) {
            return false;
        }

        if(!in_array($field, $this->userFields)) {
            return false;
        }

        return true;
    }

}
