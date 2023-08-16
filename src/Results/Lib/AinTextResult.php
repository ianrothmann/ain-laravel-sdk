<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinTextResult extends AinResult
{

    protected $newText;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);

        $this->newText=$this->data->get('text');
    }

    public function getText()
    {
        return $this->newText;
    }
}
