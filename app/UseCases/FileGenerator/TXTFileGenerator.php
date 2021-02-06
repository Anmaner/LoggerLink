<?php

namespace App\UseCases\FileGenerator;

class TXTFileGenerator implements FileGeneratorInterface
{
    protected $userFields;
    protected $divider = '|';
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

        $text = $this->generateHeaders();

        foreach ($items as $num => $item) {
            $text .= $this->generateItem($item, $num+1);
        }

        return $text;
    }

    protected function generateHeaders(): string
    {
        $div = $this->divider;

        return "#{$div}Date{$div}Time{$div}IP{$div}Provider{$div}Country{$div}City{$div}OS{$div}Browser{$div}From\r\n";
    }

    protected function generateItem($data, $num): string
    {
        $div = $this->divider;
        $text = '#' . $num . $div;

        foreach ($this->fields as $field) {
            $text .= $this->fieldIsValid($field, $data) ? $data[$field] : "-";
            $text .= $div;
        }

        return rtrim($text, $div) . "\r\n";
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
