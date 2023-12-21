<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinStrengthsShortcomingsResult extends AinResult
{

    protected $strengths;
    protected $shortcomings;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $temp=collect($this->data->get('table'))->first();
        $this->strengths=$temp['strengths'];
        $this->shortcomings=$temp['shortcomings'];
    }

    public function getStrengths():string
    {
        return $this->strengths;
    }

    public function getShortcomings():string
    {
        return $this->shortcomings;
    }
}
