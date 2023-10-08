<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinScoringResult extends AinResult
{
    protected $score;
    protected $reason;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->score=collect(collect(collect($this->data)->get('table'))->first())->get('score');
        $this->reason=collect(collect(collect($this->data)->get('table'))->first())->get('reason');
    }

    public function getReason()
    {
        return trim($this->reason);
    }
    public function getScore()
    {
        return $this->score;
    }
}
