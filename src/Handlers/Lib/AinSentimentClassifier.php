<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSentimentResult;
use IanRothmann\Ain\Results\Lib\AinSpellingGrammarResult;
use IanRothmann\Ain\Results\Lib\AinThemesResult;


class AinSentimentClassifier extends AinHandler
{
    protected array $sentences;
    protected string $endpoint='nlp/sentiment';

    public function forSentences($arrayOfSentences)
    {
        $this->sentences=$arrayOfSentences;
        return $this;
    }

    public function getResult()
    {
        $result=$this->postList($this->sentences);

        return new AinSentimentResult($result);
    }

    public function getMocked()
    {
        $result=['data'=>[]];
        $result['data']['list']=collect($this->sentences)->map(function($text){
            return [
                'sentiment'=>'positive',
                'score'=>0.5,
                'classes'=>[
                    ['label'=>'Negative','score'=>0.5],
                    ['label'=>'Positive','score'=>0.5],
                    ['label'=>'Neutral','score'=>0.5],
                ],
                'original'=>$text
            ];
        })->toArray();
        return new AinSentimentResult($result);
    }
}
