<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinIntentResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinInterviewReportWriter extends AinHandler
{
    protected $questionAnswerArray;
    protected $name;
    protected $jobDescription;
    protected $context;

    protected string $endpoint='nlp/interview_report';

    public function forQuestionsAndAnswers($array)
    {
        $this->questionAnswerArray=$array;
        return $this;
    }

    public function byName($name)
    {
        $this->name=$name;
        return $this;
    }

    public function forJobDescription($jobDescription)
    {
        $this->jobDescription=$jobDescription;
        return $this;
    }

    public function withContext($context)
    {
        $this->context=$context;
        return $this;
    }

    /**
     * @return AinSummaryResult
     */
    public function getResult()
    {
        $result=$this->post([
            'qa'=>$this->questionAnswerArray,
            'name'=>$this->name,
            'job_description'=>$this->jobDescription,
            'context'=>$this->context
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
                'text'=>'Summary',
                'original'=>'Summary',
            ]
        ];
        return new AinSummaryResult($result);
    }
}
