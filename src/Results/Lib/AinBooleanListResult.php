<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinBooleanListResult extends AinResult
{

    protected $list;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->list=collect($this->data->get('list'));
    }

    public function getBooleans():Collection
    {
        return $this->list;
    }
}
