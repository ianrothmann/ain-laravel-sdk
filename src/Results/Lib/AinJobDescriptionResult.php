<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinJobDescriptionResult extends AinResult
{

    protected $title;
    protected $summary;
    protected $requirements;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $temp=collect($this->data->get('table'))->first();
        $this->title=$temp['title'];
        $this->summary=$temp['summary'];
        $this->requirements=$temp['requirements'];
    }

    public function getTitle():string
    {
        return $this->title;
    }

    public function getSummary():string
    {
        return $this->summary;
    }

    public function getRequirements():string
    {
        return $this->requirements;
    }
}
