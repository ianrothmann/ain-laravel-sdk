<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;


class AinAnalysisResult extends AinResult
{

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
    }

    public function getAnalysis()
    {
        return $this->data->get('analysis');
    }

    public function getResults()
    {
        return $this->data->get('results');
    }

    public function getError()
    {
        return $this->data->get('error');
    }
}
