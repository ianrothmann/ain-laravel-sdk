<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinTableResult extends AinResult
{
    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
    }

    public function getData():Collection
    {
        return collect($this->data->get('table'));
    }
}
