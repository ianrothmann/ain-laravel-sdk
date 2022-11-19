<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinRewriteResult;

class AinRewriter extends AinHandler
{
    protected $inputText;
    protected string $creativity='medium';
    protected $level='';
    protected $audience='';

    protected string $endpoint='nlp/rewrite';

    public function text($text)
    {
        $this->inputText=$text;
        return $this;
    }

    public function withLowCreativity()
    {
        $this->creativity='low';
        return $this;
    }

    public function withModerateCreativity()
    {
        $this->creativity='medium';
        return $this;
    }

    public function withHighCreativity()
    {
        $this->creativity='high';
        return $this;
    }

    public function forAcademicAudience()
    {
        $this->audience='academic';
        return $this;
    }

    public function forBusinessAudience()
    {
        $this->audience='business';
        return $this;
    }

    public function targetGradeLevel($level)
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
     * @return AinRewriteResult
     */
    public function getResult()
    {
        $data=[
            'creativity'=>$this->creativity,
        ];

        if($this->level){
            $data['grade_level']=$this->level;
        }

        if($this->audience){
            $data['audience']=$this->audience;
        }

        $result=$this->postText($this->inputText,$data);
        return new AinRewriteResult($result);
    }

    /**
     * @return AinRewriteResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>$this->inputText,
                'original'=>$this->inputText,
            ]
        ];
        return new AinRewriteResult($result);
    }
}
