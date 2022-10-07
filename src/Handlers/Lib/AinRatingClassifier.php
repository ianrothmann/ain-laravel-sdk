<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinClassificationResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinRatingClassifier extends AinHandler
{
    protected $inputText;
    protected $modelName;

    protected string $endpoint='classification/judge/classify';

    public function text($text)
    {
        $this->inputText=$text;
        return $this;
    }

    public function useModel($modelName)
    {
        $this->modelName=$modelName;
        return $this;
    }

    /**
     * @return AinClassificationResult
     */
    public function getResult()
    {
        if(!$this->modelName){
            throw new \Exception("Model name must be specified.");
        }

        if(!$this->inputText){
            throw new \Exception("Input text must be specified.");
        }

        $result=$this->postText($this->inputText,[
            'model_name'=>$this->modelName
        ]);
        return new AinClassificationResult($result);
    }

    /**
     * @return AinClassificationResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>1,
            ]
        ];
        return new AinClassificationResult($result);
    }
}
