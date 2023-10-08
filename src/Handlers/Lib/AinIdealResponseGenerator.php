<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinIdealResponseGenerator extends AinHandler
{
    protected $question;
    protected $jobDescription;

    protected string $endpoint='nlp/ideal_response_generation';

    public function forQuestion($text)
    {
        $this->question=$text;
        return $this;
    }

    public function givenJobDescription($text)
    {
        $this->jobDescription=$text;
        return $this;
    }

    /**
     * @return AinSummaryResult
     */
    public function getResult()
    {
        $result=$this->post([
            'question'=>$this->question,
            'job_description'=>$this->jobDescription,
        ]);
        return new AinSummaryResult($result);
    }

    /**
     * @return AinSummaryResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>$this->inputText,
                'original'=>$this->inputText,
            ]
        ];
        return new AinSummaryResult($result);
    }
}
