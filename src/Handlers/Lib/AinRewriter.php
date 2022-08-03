<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinRewriteResult;

class AinRewriter extends AinHandler
{
    protected string $text;
    protected string $creativity='low';

    protected string $endpoint='nlp/rewrite';

    public function forText($text)
    {
        $this->text=$text;
        return $this;
    }

    public function setCreativityModerate($text)
    {
        $this->creativity='medium';
        return $this;
    }

    public function setCreativityHigh($text)
    {
        $this->creativity='high';
        return $this;
    }

    public function getResult()
    {
        $result=$this->postText($this->text,[
            'creativity'=>$this->creativity
        ]);
        return new AinRewriteResult($result);
    }

    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>$this->text,
                'original'=>$this->text,
            ]
        ];
        return new AinRewriteResult($result);
    }
}
