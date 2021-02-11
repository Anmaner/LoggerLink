<?php

namespace App\UseCases\FileGenerator;

class JsonFileGenerator implements FileGeneratorInterface
{
    protected $userFields;
    protected $resultArray = [];
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

    public function generate(array $items, array $userFields): string
    {
        $this->userFields = $userFields;

        foreach ($items as $num => $item) {
            $this->generateItem($item, $num);
        }

        return json_encode($this->resultArray);
    }

    protected function generateItem($data, $num): void
    {
        foreach ($this->fields as $field) {
            $this->resultArray[$num][$field] = $this->fieldIsValid($field, $data) ? $data[$field] : "-";
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
