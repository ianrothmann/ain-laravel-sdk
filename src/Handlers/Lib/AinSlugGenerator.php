<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;
use IanRothmann\Ain\Results\Lib\AinTextResult;

class AinSlugGenerator extends AinHandler
{
    protected $inputText;

    protected string $endpoint='nlp/slug';

    public function fromText($text)
    {
        $this->inputText=$text;
        return $this;
    }

    /**
     * @return AinTextResult
     */
    public function getResult()
    {
        $result=$this->postText($this->inputText);
        return new AinTextResult($result);
    }

    /**
     * @return AinTextResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>$this->inputText,
            ]
        ];
        return new AinTextResult($result);
    }
}
