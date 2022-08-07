<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSentimentResult;
use Illuminate\Support\Collection;

class AinSentimentClassifier extends AinHandler
{
    protected array $inputSentences;
    protected string $endpoint='nlp/sentiment';

    /**
     * @param array|Collection $arrayOfSentences
     * @return $this
     */
    public function forSentences($arrayOfSentences)
    {
        $this->inputSentences=collect($arrayOfSentences)->toArray();
        return $this;
    }

    /**
     * @return AinSentimentResult
     */
    public function getResult()
    {
        $result=$this->postList($this->inputSentences);

        return new AinSentimentResult($result);
    }

    /**
     * @return AinSentimentResult
     */
    public function getMocked()
    {
        $result=['data'=>[]];
        $result['data']['list']=collect($this->inputSentences)->map(function($text){
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
