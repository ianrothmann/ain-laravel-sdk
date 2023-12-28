<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinQuestionProbingResult extends AinResult
{

    protected $answerSufficient;
    protected $question;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $temp=collect($this->data->get('table'))->last();
        $this->answerSufficient=$temp['answer_sufficient'];
        $this->question=$temp['probing_question'];
    }

    public function shouldProbe():bool
    {
        return !$this->answerSufficient;
    }

    public function getQuestion():string
    {
        return $this->question;
    }
}
