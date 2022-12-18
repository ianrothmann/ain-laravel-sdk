<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinSummarizeTranscription extends AinHandler
{
    protected $inputText;
    protected $name;
    protected $gender;
    protected $unclear;

    protected string $endpoint='nlp/summarize_transcript';

    public function text($text)
    {
        $this->inputText=$text;
        return $this;
    }

    public function forName($name)
    {
        $this->name=$name;
        return $this;
    }

    public function isGender($gender)
    {
        $this->gender=$gender;
        return $this;
    }

    public function withUnclearWordsMarkedBy($unclearStr)
    {
        $this->unclear=$unclearStr;
        return $this;
    }

    /**
     * @return AinSummaryResult
     */
    public function getResult()
    {
        $result=$this->postText($this->inputText,[
            'unclear'=>$this->unclear,
            'name'=>$this->name,
            'gender'=>$this->gender,
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
