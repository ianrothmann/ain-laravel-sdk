<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinJsonResult extends AinResult
{

    protected $result;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);

        $this->result=collect($this->data->get('data'));
    }

    public function getResult(): Collection
    {
        return $this->data;
    }
}
