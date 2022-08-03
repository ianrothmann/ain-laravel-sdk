<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSpellingGrammarResult;
use IanRothmann\Ain\Results\Lib\AinThemesResult;


class AinSpellingGrammar extends AinHandler
{
    protected string $text;

    protected string $endpoint='nlp/grammar_spelling';

    public function forText($text)
    {
        $this->text=$text;
        return $this;
    }

    public function getResult()
    {
        $result=$this->postText($this->text);
        return new AinSpellingGrammarResult($result);
    }

    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>$this->text,
                'original'=>$this->text,
            ]
        ];
        return new AinSpellingGrammarResult($result);
    }
}
