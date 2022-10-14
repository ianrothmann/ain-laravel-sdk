<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinModelResult extends AinResult
{

    protected $modelData;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->modelData=collect($httpResultArray);
    }

    public function getName():string
    {
        return $this->modelData->get('name');
    }

    public function getState():string
    {
        return $this->modelData->get('state');
    }

    public function getParams():Collection
    {
        return collect($this->modelData->get('params'));
    }

    public function getTrainingResults():Collection
    {
        return collect($this->modelData->get('training_results'));
    }
}
