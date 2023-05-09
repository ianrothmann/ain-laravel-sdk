<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinPsychometricScoreResult extends AinResult
{

    protected $results;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->results=collect($httpResultArray);
    }

    public function getScores():Collection
    {
        return $this->results;
    }

}
