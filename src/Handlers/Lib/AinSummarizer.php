<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinRewriteResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinSummarizer extends AinHandler
{
    protected $inputText;
    protected $firstPerson=0;
    protected $targetLevel=null;

    protected string $endpoint='nlp/summarize';

    public function text($text)
    {
        $this->inputText=$text;
        return $this;
    }

    /**
     * Return the summary in the first person
     * @param $level
     * @return $this
     * @throws \Exception
     */
    public function inFirstPerson()
    {
        $this->firstPerson=1;
        return $this;
    }

    /**
     * Specify a target grade level (school grades) between 1 and 12.
     * @param $level
     * @return $this
     * @throws \Exception
     */
    public function forTargetGradeLevel($level)
    {
        if(intval($level)!=$level){
            throw new \Exception("Level must be an integer between 1 and 12.");
        }
        if($level < 1 || $level > 12){
            throw new \Exception("Level must be an integer between 1 and 12.");
        }
        $this->targetLevel=$level;
        return $this;
    }

    /**
     * @return AinSummaryResult
     */
    public function getResult()
    {
        $params=[
            'first_person'=>$this->firstPerson,
        ];
        if($this->targetLevel){
            $params['grade_level']=$this->targetLevel;
        }
        $result=$this->postText($this->inputText,$params);
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
