<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinQuestionProbingResult;
use IanRothmann\Ain\Results\Lib\AinScoringResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinInterviewQuestionProber extends AinHandler
{
    use LanguageSupport;
    protected $question;
    protected $responseText;
    protected $otherQuestions;

    protected $context;
    protected $idealAnswerText;
    protected $questionResponseType;

    protected string $endpoint='nlp/interview_question_probing';

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

    public function withOtherQuestions($arrOfQuestions)
    {
        $this->otherQuestions=$arrOfQuestions;
        return $this;
    }

    public function withCandidateContext($text)
    {
        $this->context=$text;
        return $this;
    }

    /**
     * @return AinQuestionProbingResult
     */
    public function getResult()
    {
        $result=$this->post([
            'question'=>$this->question,
            'response'=>$this->responseText,
            'context'=>$this->context,
            'other_questions'=>$this->otherQuestions,
            'ideal_answer'=>$this->idealAnswerText,
            'question_response_type'=>$this->questionResponseType,
        ]);

        return new AinQuestionProbingResult($result);
    }

    /**
     * @return AinQuestionProbingResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'answer_sufficient'=>'no',
                'probing_question'=>'This is a question',
            ]
        ];
        return new AinQuestionProbingResult($result);
    }
}
