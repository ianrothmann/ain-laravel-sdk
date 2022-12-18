<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinListResult extends AinResult
{

    protected $list;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        if($this->multipleResults){
            $this->list=$this->mapResult('list');
        }else{
            $this->list=collect($this->data->get('list'));
        }
    }

    public function getList():Collection
    {
        return $this->list;
    }
}
