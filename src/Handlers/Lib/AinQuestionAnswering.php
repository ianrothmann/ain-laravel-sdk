<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinQuestionAnsweringResult;
use IanRothmann\Ain\Results\Lib\AinRewriteResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinQuestionAnswering extends AinHandler
{
    protected $inputText;
    protected $context=null;
    protected $question=null;

    protected string $endpoint='nlp/question_answers';

    public function text($text)
    {
        $this->inputText=$text;
        return $this;
    }

    public function inContextOf($context)
    {
        $this->context=$context;
        return $this;
    }

    public function askQuestion($question)
    {
        $this->question=$question;
        return $this;
    }


    /**
     * @return AinQuestionAnsweringResult
     */
    public function getResult()
    {
        $params=[
            'context'=>$this->context,
            'question'=>$this->question,
        ];

        $result=$this->postText($this->inputText,$params);
        return new AinQuestionAnsweringResult($result);
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
        return new AinQuestionAnsweringResult($result);
    }
}
