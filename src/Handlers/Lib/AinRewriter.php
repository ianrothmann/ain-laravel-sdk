<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinRewriteResult;

class AinRewriter extends AinHandler
{
    protected string $inputText;
    protected string $creativity='medium';

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

    /**
     * @return AinRewriteResult
     */
    public function getResult()
    {
        $result=$this->postText($this->inputText,[
            'creativity'=>$this->creativity
        ]);
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
