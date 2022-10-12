<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinDatasetResult extends AinResult
{

    protected $dataset;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->dataset=$this->data;
    }

    public function getDataset()
    {
        return $this->dataset;
    }
}
