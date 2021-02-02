<?php

namespace App\UseCases\RequestManager;

class ArrayRequestManager implements RequestManagerInterface
{
    protected $result;

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function load($url)
    {
        return $this->result;
    }
}
