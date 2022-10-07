<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinClassificationResult extends AinResult
{

    protected $category;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->category=$this->data->get('text');
    }

    public function getCategory():string
    {
        return $this->category;
    }
}
