<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinListResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinInterviewQuestionGenerator extends AinHandler
{
    protected $inputText;
    protected $answerFormat;

    protected string $endpoint='nlp/interview_questions';

    public function forJobDescription($text)
    {
        $this->inputText=$text;
        return $this;
    }

    public function inAnswerFormat($answerFormatAsSentence)
    {
        $this->answerFormat=$answerFormatAsSentence;
        return $this;
    }

    /**
     * @return AinListResult
     */
    public function getResult()
    {
        $result=$this->post([
            'text'=>$this->inputText,
            'answer_format'=>$this->answerFormat,
        ]);
        return new AinListResult($result);
    }

    /**
     * @return AinListResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'list'=>[
                    'What is your greatest weakness?',
                    'What is your greatest strength?',
                ],
                'original'=>$this->inputText,
            ]
        ];
        return new AinListResult($result);
    }
}
