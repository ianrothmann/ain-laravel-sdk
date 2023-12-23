<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinScoringResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinIdealResponseRater extends AinHandler
{
    use LanguageSupport;
    protected $question;
    protected $responseText;
    protected $jobDescription;

    protected $context;
    protected $idealAnswerText;
    protected $questionResponseType;

    protected string $endpoint='nlp/ideal_answer_rating';

    public function forQuestion($text)
    {
        $this->question=$text;
        return $this;
    }

    public function givenResponse($text)
    {
        $this->responseText=$text;
        return $this;
    }

    public function givenResponseType($type)
    {
        if (!in_array($type, ['text', 'video', 'audio'])){
            throw new \Exception('Invalid response type. Must be one of text, video or audio');
        }

        $this->questionResponseType=$type;
        return $this;
    }

    public function givenAnIdealAnswerOf($text)
    {
        $this->idealAnswerText=$text;
        return $this;
    }

    public function forJobDescription($text)
    {
        $this->jobDescription=$text;
        return $this;
    }

    public function withCandidateContext($text)
    {
        $this->context=$text;
        return $this;
    }

    /**
     * @return AinScoringResult
     */
    public function getResult()
    {
        $result=$this->post([
            'question'=>$this->question,
            'response'=>$this->responseText,
            'context'=>$this->context,
            'job_description'=>$this->jobDescription,
            'ideal_answer'=>$this->idealAnswerText,
            'question_response_type'=>$this->questionResponseType,
        ]);

        return new AinScoringResult($result);
    }

    /**
     * @return AinScoringResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'score'=>5,
                'original'=>'This is the reason.',
            ]
        ];
        return new AinScoringResult($result);
    }
}
