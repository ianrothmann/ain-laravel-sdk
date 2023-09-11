<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinInterviewQuestionResult extends AinResult
{

    protected $questions;
    protected $multipleResults=false;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->questions=collect($this->data->get('table'));
    }

    public function getQuestions():Collection
    {
        return $this->questions;
    }
}
