<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSpellingGrammarResult;


class AinSpellingGrammar extends AinHandler
{
    protected $inputText;

    protected string $endpoint='nlp/grammar_spelling';

    public function text($text)
    {
        $this->inputText=$text;
        return $this;
    }

    /**
     * @return AinSpellingGrammarResult
     */
    public function getResult()
    {
        $result=$this->postText($this->inputText);
        return new AinSpellingGrammarResult($result);
    }

    /**
     * @return AinSpellingGrammarResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>$this->inputText,
                'original'=>$this->inputText,
            ]
        ];
        return new AinSpellingGrammarResult($result);
    }
}
