<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinKeywordsResult;


class AinKeywordExtractor extends AinHandler
{
    protected string $text;

    protected string $endpoint='nlp/keywords';

    public function fromText($text)
    {
        $this->text=$text;
        return $this;
    }

    /**
     * @return AinKeywordsResult
     */
    public function getResult()
    {
        $result=$this->postText($this->text);
        return new AinKeywordsResult($result);
    }

    /**
     * @return AinKeywordsResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'list'=>['Keyword 1','Keyword 2','Keyword 3'],
                'original'=>$this->text
            ]
        ];
        return new AinKeywordsResult($result);
    }
}
