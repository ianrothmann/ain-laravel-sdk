<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinInterviewQuestionResult;
use IanRothmann\Ain\Results\Lib\AinListResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinInterviewQuestionGenerator extends AinHandler
{
    use LanguageSupport;

    protected $inputText;

    protected string $endpoint='nlp/interview_questions';

    public function forJobDescription($text)
    {
        $this->inputText=$text;
        return $this;
    }

    /**
     * @return AinInterviewQuestionResult
     */
    public function getResult()
    {
        $result=$this->post([
            'text'=>$this->inputText,
        ]);
        return new AinInterviewQuestionResult($result);
    }

    /**
     * @return AinInterviewQuestionResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'table'=>[
                    [
                        'question'=>'Question 1',
                        'answer_format'=>'audio',
                        'options'=>[],
                        'required'=>1
                    ],
                    [
                        'question'=>'Question 2',
                        'answer_format'=>'What is your favourite drink',
                        'options'=>[
                            'Coke',
                            'Pepsi',
                            'Fanta'
                        ],
                        'required'=>0
                    ]
                ],
                'original'=>$this->inputText,
            ]
        ];
        return new AinInterviewQuestionResult($result);
    }
}
